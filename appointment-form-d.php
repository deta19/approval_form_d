<?php 
/**
 * Plugin Name: Appointment Form D
 * Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 * Description: Basic WordPress Plugin Header Comment
 * Version:     0.1
 * Author:      Mdeta
 * Author URI:  https://developer.wordpress.org/
 * Text Domain: appointment_form_d
 * Domain Path: /languages
 * License:     GPL2
 * License URId: https://opensource.org/licenses/GPL-2.0
 * {Appointment Form D} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * 
 * {Appointment Form D} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with {Appointment Form D}. If not, see {License URI}.
 */
if ( !class_exists( 'AppointmentFormD' ) ) {
    class AppointmentFormD 
    {
        public function __construct() {
            register_activation_hook( array($this, 'activate') );
            register_deactivation_hook( array($this, 'deactivate') );
            register_uninstall_hook( array($this, 'uninstall') );
        }

        /*
        * Shtuff to do on plugin activation
        */
        public function activate() {

        }
        /*
        * Shtuff to do on plugin deactivation
        */
        public function activate() {
            // back end
            add_action		( 'plugins_loaded', 					array( $this, 'textdomain'				) 			);
            add_action		( 'admin_enqueue_scripts',				array( $this, 'admin_scripts'			)			);
            add_action		( 'do_meta_boxes',						array( $this, 'create_metaboxes'		),	10,	2	);
            add_action		( 'save_post',							array( $this, 'save_custom_meta'		),	1		);

            // front end
            add_action		( 'wp_enqueue_scripts',					array( $this, 'front_scripts'			),	10		);
            add_filter		( 'comment_form_defaults',				array( $this, 'custom_notes_filter'		) 			);

        }

        /*
        * Shtuff to do on plugin uninstall
        */
        public function uninstall() {
            // $option_name = 'wporg_option';
    
            // delete_option($option_name);
            
            // // for site options in Multisite
            // delete_site_option($option_name);
            
            // // drop a custom database table
            // global $wpdb;
            // $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mytable");
        }

        public function admin_scripts() {

            $types = $this->get_post_types();
    
            $screen	= get_current_screen();
    
            if ( in_array( $screen->post_type , $types ) ) :
    
                wp_enqueue_style( 'wpcmn-admin', plugins_url('lib/css/admin.css', __FILE__), array(), WPCMN_VER, 'all' );
    
            endif;
    
        }

        public function textdomain() {

            load_plugin_textdomain( 'appointment_form_d', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    
        }

    }
}