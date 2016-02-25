<?php
/*
Plugin Name: RBW Functionality
Description: Basic functions designed to customize and enhance the RBW experience.
Author: Kyle Maurer
Version: 1.0
Author URI: http://realbigmarketing.com
*/

// We don't have access to some nicer ways of including local files, so this makes our lives easier
if ( is_multisite() ) {
	define( 'RBW_PLUGIN_URL', network_site_url( '/wp-content/mu-plugins/rbw-functionality' ) );
} 
else {
	define( 'RBW_PLUGIN_URL', content_url( '/mu-plugins/rbw-functionality' ) );
}

/*-------------------------------
Login CSS
-------------------------------*/
add_action( 'login_enqueue_scripts', 'rbw_admin_css' );
function rbw_admin_css() {
    
    wp_enqueue_style( 'global-rbw-styles', RBW_PLUGIN_URL . '/css/login.css' );
    
}
/*-------------------------------
Change footer text
-------------------------------*/
add_filter( 'admin_footer_text', 'rbw_footer_admin' );
function rbw_footer_admin () {
    echo 'Powered by <a href="http://www.wordpress.org">WordPress</a> | Designed and managed by <a href="http://realbigmarketing.com/?utm_source=RBWadmin-footer&utm_medium=footer-link&utm_campaign=RBWdashboard">Real Big Marketing</a></p>';
}

// This hooks in ASAP to place it first in the List
add_action( 'admin_bar_menu', 'add_rbm_admin_bar_item' );
function add_rbm_admin_bar_item( $wp_admin_bar ) {
     
    $wp_admin_bar->add_menu( array(
        // Non-semantic inner <span> is for the blurred bulb overlay
        'id' => 'rbm-logo',
        'title' => '<span class="st-icon-rbm-logo"><span></span></span>' . __( 'Real Big Marketing' ),
        'href' => 'http://realbigmarketing.com/'
    ) );
    
}

// This needs to be hooked in later to insure that the WP Logo has been included by Core
// At Priority 50 both wp-logo and updates have been added
add_action( 'admin_bar_menu', 'remove_wp_logo_admin_bar', 51 );
function remove_wp_logo_admin_bar( $wp_admin_bar ) {
    
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'updates' );
    
}

// This needs to also be hooked into the frontend to ensure the Logo shows to logged in Users on the Frontend as well
add_action( 'wp_enqueue_scripts', 'global_rbw_admin_styles' );
add_action( 'admin_enqueue_scripts', 'global_rbw_admin_styles' );
function global_rbw_admin_styles() {
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
    wp_enqueue_style( 'global-rbw-styles', RBW_PLUGIN_URL . '/css/style.css' );
    
}

?>