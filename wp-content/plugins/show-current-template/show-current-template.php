<?php
/**
Plugin Name: Show Current Template
Plugin URI: https://wp.tekapo.com/
Description: Show the current template file name in the tool bar. <a href="https://wp.tekapo.com/is-my-plugin-useful/">Is this useful for you?</a>
Author: JOTAKI Taisuke
Version: 0.4.5
Author URI: https://tekapo.com/
Text Domain: show-current-template
Domain Path: /languages/

License:
Released under the GPL license
http://www.gnu.org/copyleft/gpl.html

Copyright 2013 (email : tekapo@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * */

define( 'WPSCT_VERSION', '0.4.5' );

load_plugin_textdomain( 'show-current-template', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

new Show_Template_File_Name();

class Show_Template_File_Name {
	
	public $debug_info = [];

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'get_included_files_at_footr' ) );

		add_action( 'admin_bar_menu', array( &$this, 'show_template_file_name_on_top' ), 9999 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'add_current_template_stylesheet' ), 9999 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'add_current_template_js' ), 9999 );
	}

	public function show_template_file_name_on_top( $wp_admin_bar ) {

		if ( is_admin() || ! is_super_admin() ) {
			return;
		}

		global $template;

		$template_file_name     = basename( $template );
		$template_relative_path = str_replace( ABSPATH . 'wp-content/', '', $template );

		$current_theme      = wp_get_theme();
		$current_theme_name = $current_theme->Name;
		$parent_theme_name  = '';

		if ( is_child_theme() ) {
			$child_theme_name  = __( 'Theme name: ', 'show-current-template' )
					. $current_theme_name;
			$parent_theme_name = $current_theme->parent()->Name;
			$parent_theme_name = ' (' . $parent_theme_name
					. __( "'s child", 'show-current-template' ) . ')';
			$parent_or_child   = $child_theme_name . $parent_theme_name;
		} else {
			$parent_or_child = __( 'Theme name: ', 'show-current-template' )
					. $current_theme_name . ' (' . __( 'NOT a child theme', 'show-current-template' ) . ')';
		}

		$included_files = get_included_files();

		sort( $included_files );
		$included_files_list = '';
		foreach ( $included_files as $filename ) {
			if ( strstr( $filename, 'themes' ) ) {
				$filepath = strstr( $filename, 'themes' );
				if ( $template_relative_path === $filepath ) {
					$included_files_list .= '';
				} else {
					$included_files_list .= '<li>' . "$filepath" . '</li>';
				}
			}
		}
		
		$debug_info_1 = var_export( $included_files_list, true );
		$comment_out_debug_info_format_1 = '
<!-- 
::Debug info 1 start::

##show_template_file_name_on_top##

%s

::Debug info 1 end::
-->
';
		$this->debug_info[1] = sprintf( $comment_out_debug_info_format_1, $debug_info_1 );

		global $wp_admin_bar;
		$args = array(
			'id'    => 'show_template_file_name_on_top',
			'title' => __( 'Template:', 'show-current-template' )
			. '<span class="show-template-name"> ' . $template_file_name . '</span>',
		);

		$wp_admin_bar->add_node( $args );

		$wp_admin_bar->add_menu(
			array(
				'parent' => 'show_template_file_name_on_top',
				'id'     => 'template_relative_path',
				'title'  => __( 'Template relative path:', 'show-current-template' )
				. '<span class="show-template-name"> ' . $template_relative_path . '</span>',
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'parent' => 'show_template_file_name_on_top',
				'id'     => 'is_child_theme',
				'title'  => $parent_or_child,
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'parent' => 'show_template_file_name_on_top',
				'id'     => 'included_files_path',
				'title'  => __( 'Also, below template files are included:', 'show-current-template' )
				. '<br /><ul id="included-files-list">'
				. $included_files_list
				. '</ul>',
			)
		);
	}

	public function get_included_files_at_footr() {

		if ( is_admin() || ! is_super_admin() ) {
			return;
		}

		$included_files = get_included_files();
		global $template;

		$template_relative_path = str_replace( ABSPATH . 'wp-content/', '', $template );

		sort( $included_files );
		$included_files_list = '';
		foreach ( $included_files as $filename ) {
			if ( strstr( $filename, 'themes' . DIRECTORY_SEPARATOR ) ) {
				$filepath = strstr( $filename, 'themes' );
				if ( $template_relative_path === $filepath ) {
					$included_files_list .= '';
				} else {
					$included_files_list .= '<li>' . "$filepath" . '</li>';
				}
			}
		}
		$included_files_format = '<ol id="included-files-fie-on-wp-footer">'
				. '%s'
				. '</ol>';
		$included_files_html = sprintf( $included_files_format, $included_files_list );
		
		$debug_info_2 = var_export( $included_files, true );
		$comment_out_debug_info_format_2 = '
<!-- 
::Debug info 2 start::

##get_included_files_at_footr##

%s

::Debug info 2 end::
-->
';
		$this->debug_info[2] = sprintf( $comment_out_debug_info_format_2, $debug_info_2 );
		
//		echo $this->debug_info[1];
//		echo $this->debug_info[2];
		echo wp_kses_post( $included_files_html );
	}

	public function add_current_template_stylesheet() {

		if ( is_admin() || ! is_super_admin() ) {
			return;
		}

		$wp_version = get_bloginfo( 'version' );

		if ( $wp_version >= '3.8' ) {
			$is_older_than_3_8 = '';
		} else {
			$is_older_than_3_8 = '-old';
		}

		$stylesheet_path = plugins_url( 'css/style' . $is_older_than_3_8 . '.css', __FILE__ );
		wp_register_style( 'current-template-style', $stylesheet_path, array(), WPSCT_VERSION );
		wp_enqueue_style( 'current-template-style' );
	}
	public function add_current_template_js() {

		if ( is_admin() || ! is_super_admin() ) {
			return;
		}

		$wp_version = get_bloginfo( 'version' );

		if ( $wp_version >= '5.4' ) {
			$js_path = plugins_url( 'assets/js/replace.js', __FILE__ );
			wp_register_script( 'current-template-js', $js_path, array( 'jquery' ), WPSCT_VERSION, true );
			wp_enqueue_script( 'current-template-js' );
		} else {
			return;
		}
	}
}
