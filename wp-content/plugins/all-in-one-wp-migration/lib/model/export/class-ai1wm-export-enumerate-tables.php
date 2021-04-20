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

class Ai1wm_Export_Enumerate_Tables {

	public static function execute( $params, Ai1wm_Database $mysql = null ) {
		global $wpdb;

		// Set exclude database
		if ( isset( $params['options']['no_database'] ) ) {
			return $params;
		}

		// Get total tables count
		if ( isset( $params['total_tables_count'] ) ) {
			$total_tables_count = (int) $params['total_tables_count'];
		} else {
			$total_tables_count = 0;
		}

		// Set progress
		Ai1wm_Status::info( __( 'Retrieving a list of WordPress database tables...', AI1WM_PLUGIN_NAME ) );

		// Get database client
		if ( is_null( $mysql ) ) {
			if ( empty( $wpdb->use_mysqli ) ) {
				$mysql = new Ai1wm_Database_Mysql( $wpdb );
			} else {
				$mysql = new Ai1wm_Database_Mysqli( $wpdb );
			}
		}

		// Include table prefixes
		if ( ai1wm_table_prefix() ) {
			$mysql->add_table_prefix_filter( ai1wm_table_prefix() );
		} else {
			foreach ( $mysql->get_tables() as $table_name ) {
				$mysql->add_table_prefix_filter( $table_name );
			}
		}

		// Include table prefixes (Webba Booking)
		foreach ( array( 'wbk_services', 'wbk_days_on_off', 'wbk_locked_time_slots', 'wbk_appointments', 'wbk_cancelled_appointments', 'wbk_email_templates', 'wbk_service_categories', 'wbk_gg_calendars', 'wbk_coupons' ) as $table_name ) {
			$mysql->add_table_prefix_filter( $table_name );
		}

		// Create tables list file
		$tables_list = ai1wm_open( ai1wm_tables_list_path( $params ), 'w' );

		// Write table line
		foreach ( $mysql->get_tables() as $table_name ) {
			if ( ai1wm_write( $tables_list, $table_name . PHP_EOL ) ) {
				$total_tables_count++;
			}
		}

		// Set progress
		Ai1wm_Status::info( __( 'Done retrieving a list of WordPress database tables.', AI1WM_PLUGIN_NAME ) );

		// Set total tables count
		$params['total_tables_count'] = $total_tables_count;

		// Close the tables list file
		ai1wm_close( $tables_list );

		return $params;
	}
}
