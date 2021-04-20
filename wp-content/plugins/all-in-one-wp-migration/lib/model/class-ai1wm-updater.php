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

class Ai1wm_Updater {

	/**
	 * Retrieve plugin installer pages from WordPress Plugins API.
	 *
	 * @param  mixed        $result
	 * @param  string       $action
	 * @param  array|object $args
	 * @return mixed
	 */
	public static function plugins_api( $result, $action = null, $args = null ) {
		if ( empty( $args->slug ) ) {
			return $result;
		}

		// Get extensions
		$extensions = Ai1wm_Extensions::get();

		// View details page
		if ( isset( $extensions[ $args->slug ] ) && $action === 'plugin_information' ) {
			$updater = get_option( AI1WM_UPDATER, array() );

			// Plugin details
			if ( isset( $updater[ $args->slug ] ) ) {
				return (object) $updater[ $args->slug ];
			}
		}

		return $result;
	}

	/**
	 * Update WordPress plugin list page.
	 *
	 * @param  object $transient
	 * @return object
	 */
	public static function update_plugins( $transient ) {
		global $wp_version;

		// Creating default object from empty value
		if ( ! is_object( $transient ) ) {
			$transient = (object) array();
		}

		// Get extensions
		$extensions = Ai1wm_Extensions::get();

		// Get current updates
		$updater = get_option( AI1WM_UPDATER, array() );

		// Get extension updates
		foreach ( $updater as $slug => $update ) {
			if ( isset( $extensions[ $slug ] ) && ( $extension = $extensions[ $slug ] ) ) {
				if ( ( $purchase_id = get_option( $extension['key'] ) ) ) {

					// Get download URL
					if ( $update['slug'] === 'file-extension' ) {
						$download_url = add_query_arg( array( 'siteurl' => get_site_url() ), sprintf( '%s', $update['download_link'] ) );
					} else {
						$download_url = add_query_arg( array( 'siteurl' => get_site_url() ), sprintf( '%s/%s', $update['download_link'], $purchase_id ) );
					}

					// Set plugin details
					$plugin_details = (object) array(
						'slug'        => $slug,
						'new_version' => $update['version'],
						'url'         => $update['homepage'],
						'plugin'      => $extension['basename'],
						'package'     => $download_url,
						'tested'      => $wp_version,
						'icons'       => $update['icons'],
					);

					// Enable manual and auto updates
					if ( version_compare( $extension['version'], $update['version'], '<' ) ) {
						$transient->response[ $extension['basename'] ] = $plugin_details;
					} else {
						$transient->no_update[ $extension['basename'] ] = $plugin_details;
					}
				}
			}
		}

		return $transient;
	}

	/**
	 * Check for extension updates
	 *
	 * @return boolean
	 */
	public static function check_for_updates() {
		$updater = get_option( AI1WM_UPDATER, array() );

		// Get extension updates
		foreach ( Ai1wm_Extensions::get() as $slug => $extension ) {
			$about = wp_remote_get(
				$extension['about'],
				array(
					'timeout' => 15,
					'headers' => array( 'Accept' => 'application/json' ),
				)
			);

			// Add plugin updates
			if ( ! is_wp_error( $about ) ) {
				$body = wp_remote_retrieve_body( $about );
				if ( ( $data = json_decode( $body, true ) ) ) {
					if ( isset( $data['slug'], $data['version'], $data['homepage'], $data['download_link'] ) ) {
						$updater[ $slug ] = $data;
					}
				}
			}

			// Add plugin messages
			if ( ( $purchase_id = get_option( $extension['key'] ) ) ) {
				$check = wp_remote_get(
					add_query_arg( array( 'site_url' => get_site_url(), 'admin_email' => get_option( 'admin_email' ) ), sprintf( '%s/%s', $extension['check'], $purchase_id ) ),
					array(
						'timeout' => 15,
						'headers' => array( 'Accept' => 'application/json' ),
					)
				);

				// Add plugin checks
				if ( ! is_wp_error( $check ) ) {
					$body = wp_remote_retrieve_body( $check );
					if ( ( $data = json_decode( $body, true ) ) ) {
						if ( isset( $updater[ $slug ], $data['message'] ) ) {
							$updater[ $slug ]['update_message'] = $data['message'];
						}
					}
				}
			}
		}

		return update_option( AI1WM_UPDATER, $updater );
	}

	/**
	 * Add "Check for updates" link
	 *
	 * @param  array  $links The array having default links for the plugin.
	 * @param  string $file  The name of the plugin file.
	 * @return array
	 */
	public static function plugin_row_meta( $links, $file ) {
		$modal_index = 0;

		// Add link for each extension
		foreach ( Ai1wm_Extensions::get() as $slug => $extension ) {
			$modal_index++;

			// Get plugin details
			if ( $file === $extension['basename'] ) {

				// Get updater URL
				$updater_url = add_query_arg( array( 'ai1wm_check_for_updates' => 1, 'ai1wm_nonce' => wp_create_nonce( 'ai1wm_check_for_updates' ) ), network_admin_url( 'plugins.php' ) );

				// Check purchase ID
				if ( get_option( $extension['key'] ) ) {
					$links[] = Ai1wm_Template::get_content( 'updater/check', array( 'url' => $updater_url ) );
				} else {
					$links[] = Ai1wm_Template::get_content( 'updater/modal', array( 'url' => $updater_url, 'modal' => $modal_index ) );
				}
			}
		}

		return $links;
	}
}
