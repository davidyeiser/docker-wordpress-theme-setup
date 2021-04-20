<?php
/**
 * Copyright (C) 2014-2020 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}

class Ai1wm_Export_Enumerate_Content {

	public static function execute( $params ) {

		$exclude_filters = array( ai1wm_get_uploads_dir() );

		// Get total content files count
		if ( isset( $params['total_content_files_count'] ) ) {
			$total_content_files_count = (int) $params['total_content_files_count'];
		} else {
			$total_content_files_count = 0;
		}

		// Get total content files size
		if ( isset( $params['total_content_files_size'] ) ) {
			$total_content_files_size = (int) $params['total_content_files_size'];
		} else {
			$total_content_files_size = 0;
		}

		// Set progress
		Ai1wm_Status::info( __( 'Retrieving a list of WordPress content files...', AI1WM_PLUGIN_NAME ) );

		// Exclude cache
		if ( isset( $params['options']['no_cache'] ) ) {
			$exclude_filters[] = 'cache';
		}

		// Exclude themes
		if ( isset( $params['options']['no_themes'] ) ) {
			$exclude_filters[] = 'themes';
		} else {
			$inactive_themes = array();

			// Exclude inactive themes
			if ( isset( $params['options']['no_inactive_themes'] ) ) {
				foreach ( search_theme_directories() as $theme => $info ) {
					// Exclude current parent and child themes
					if ( ! in_array( $theme, array( get_template(), get_stylesheet() ) ) ) {
						$inactive_themes[] = 'themes' . DIRECTORY_SEPARATOR . $theme;
					}
				}
			}

			$exclude_filters = array_merge( $exclude_filters, $inactive_themes );
		}

		// Exclude must-use plugins
		if ( isset( $params['options']['no_muplugins'] ) ) {
			$exclude_filters[] = 'mu-plugins';
		}

		// Exclude plugins
		if ( isset( $params['options']['no_plugins'] ) ) {
			$exclude_filters[] = 'plugins';
		} else {
			$inactive_plugins = array();

			// Exclude inactive plugins
			if ( isset( $params['options']['no_inactive_plugins'] ) ) {
				foreach ( get_plugins() as $plugin => $info ) {
					if ( is_plugin_inactive( $plugin ) ) {
						$inactive_plugins[] = 'plugins' . DIRECTORY_SEPARATOR . ( ( dirname( $plugin ) === '.' ) ? basename( $plugin ) : dirname( $plugin ) );
					}
				}
			}

			$exclude_filters = array_merge( $exclude_filters, ai1wm_plugin_filters( $inactive_plugins ) );
		}

		// Exclude media
		if ( isset( $params['options']['no_media'] ) ) {
			$exclude_filters[] = 'blogs.dir';
		}

		$user_filters = array();

		// Exclude selected files
		if ( isset( $params['options']['exclude_files'], $params['excluded_files'] ) ) {
			$excluded_files = explode( ',', $params['excluded_files'] );
			if ( $excluded_files ) {
				foreach ( $excluded_files as $excluded_path ) {
					$user_filters[] = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . untrailingslashit( $excluded_path );
				}
			}

			$exclude_filters = array_merge( $exclude_filters, $user_filters );
		}

		// Create content list file
		$content_list = ai1wm_open( ai1wm_content_list_path( $params ), 'w' );

		// Enumerate over content directory
		if ( isset( $params['options']['no_themes'], $params['options']['no_muplugins'], $params['options']['no_plugins'] ) === false ) {

			// Iterate over content directory
			$iterator = new Ai1wm_Recursive_Directory_Iterator( WP_CONTENT_DIR );

			// Exclude content files
			$iterator = new Ai1wm_Recursive_Exclude_Filter( $iterator, apply_filters( 'ai1wm_exclude_content_from_export', ai1wm_content_filters( $exclude_filters ) ) );

			// Recursively iterate over content directory
			$iterator = new Ai1wm_Recursive_Iterator_Iterator( $iterator, RecursiveIteratorIterator::LEAVES_ONLY, RecursiveIteratorIterator::CATCH_GET_CHILD );

			// Write path line
			foreach ( $iterator as $item ) {
				if ( $item->isFile() ) {
					if ( ai1wm_write( $content_list, $iterator->getSubPathname() . PHP_EOL ) ) {
						$total_content_files_count++;

						// Add current file size
						$total_content_files_size += $iterator->getSize();
					}
				}
			}
		}

		// Set progress
		Ai1wm_Status::info( __( 'Done retrieving a list of WordPress content files.', AI1WM_PLUGIN_NAME ) );

		// Set total content files count
		$params['total_content_files_count'] = $total_content_files_count;

		// Set total content files size
		$params['total_content_files_size'] = $total_content_files_size;

		// Close the content list file
		ai1wm_close( $content_list );

		return $params;
	}
}
