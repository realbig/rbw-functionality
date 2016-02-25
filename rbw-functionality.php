<?php
/*
Plugin Name: RBW Functionality
Description: Basic functions designed to customize and enhance the RBW experience.
Author: Kyle Maurer
Version: 1.0
Author URI: http://realbigmarketing.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'RBW_Functionality' ) ) {
    
    class RBW_Functionality {
        
        private static $instance;
        
        public static function get_instance() {
            
            if ( ! self::$instance ) {
                
                self::$instance = new RBW_Functionality();
                self::$instance->setup_constants();
                self::$instance->hooks();
                
            }
            
        }
        
        private function setup_constants() {
            
            // We don't have access to some nicer ways of including local files, so this makes our lives easier
            if ( is_multisite() ) {
                define( 'RBW_PLUGIN_URL', network_site_url( '/wp-content/mu-plugins/rbw-functionality' ) );
            } 
            else {
                define( 'RBW_PLUGIN_URL', content_url( '/mu-plugins/rbw-functionality' ) );
            }
            
        }

        private function hooks() {
            
            // Slightly later priority to ensure our Initializing function hits first
            add_action( 'init', array( $this, 'register_scripts' ), 11 );
            
            add_action( 'login_enqueue_scripts', array( $this, 'login_css' ) );
            
            // This needs to also be hooked into the Frontend to ensure the Logo shows to Users on the Frontend as well
            add_action( 'wp_enqueue_scripts', array( $this, 'global_styles' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'global_styles' ) );
            
            // This hooks in ASAP to place it first in the List
            add_action( 'admin_bar_menu', array( $this, 'add_rbm_admin_bar_item' ) );
            
            // This needs to be hooked in later to insure that the WP Logo and Updates have been included by Core
            // At Priority 50 both wp-logo and updates have been added
            add_action( 'admin_bar_menu', array( $this, 'remove_wp_logo_admin_bar' ), 51 );
            
            add_filter( 'admin_footer_text', array( $this, 'footer_admin' ) );
            
        }
        
        public function register_scripts() {

            wp_register_style( 'rbw-login-styles', RBW_PLUGIN_URL . '/css/login.css' );
            wp_register_style( 'rbw-global-styles', RBW_PLUGIN_URL . '/css/style.css' );

        }

        public function login_css() {

            wp_enqueue_style( 'rbw-login-styles' );

        }
        
        public function global_styles() {
            ?>
            <style type="text/css">
                @font-face {
                    font-family: 'rbmlogo';
                    src:url( <?php echo RBW_PLUGIN_URL . '/fonts/icons/rbm-logo.eot?1g7jui'; ?> );
                    src:url( <?php echo RBW_PLUGIN_URL . '/fonts/icons/rbm-logo.eot?1g7jui#iefix'; ?> ) format('embedded-opentype'),
                    url( <?php echo RBW_PLUGIN_URL . '/fonts/icons/rbm-logo.woff?1g7jui'; ?> ) format('woff'),
                    url( <?php echo RBW_PLUGIN_URL . '/fonts/icons/rbm-logo.ttf?1g7jui'; ?> ) format('truetype'),
                    url( <?php echo RBW_PLUGIN_URL . '/fonts/icons/rbm-logo.svg?1g7jui#rbm-logo'; ?> ) format('svg');
                    font-weight: normal;
                    font-style: normal;
                }
            </style>
            <?php
            wp_enqueue_style( 'rbw-global-styles' );

        }
        
        public function add_rbm_admin_bar_item( $wp_admin_bar ) {

            $wp_admin_bar->add_menu( array(
                // Non-semantic inner <span> is for the blurred bulb overlay
                'id' => 'rbm-logo',
                'title' => '<span class="stacked-rbm-logo-icon"><span></span></span>' . __( 'Real Big Marketing' ),
                'href' => 'http://realbigmarketing.com/'
            ) );

        }

        public function remove_wp_logo_admin_bar( $wp_admin_bar ) {

            $wp_admin_bar->remove_menu( 'wp-logo' );
            $wp_admin_bar->remove_menu( 'updates' );

        }

        public function footer_admin () {
            echo 'Powered by <a href="http://www.wordpress.org">WordPress</a> | Designed and managed by <a href="http://realbigmarketing.com/?utm_source=RBWadmin-footer&utm_medium=footer-link&utm_campaign=RBWdashboard">Real Big Marketing</a></p>';
        }
        
    }
    
    add_action( 'init', 'RBW_Functionality_load' );
    function RBW_Functionality_load() {
        
        return RBW_Functionality::get_instance();
        
    }
    
}