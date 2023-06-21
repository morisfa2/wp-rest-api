<?php

/**
 * @wordpress-plugin
 * Plugin Name:       wp-rest-api
 * Plugin URI:        https://morisfa.com/
 * Description:       a plugin for easy Login-register and User data with rest api
 * Version:           1.0.7
 * Author:            morisfa
 * Author URI:        https://morisfa.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       morisfa
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
    die;
}

//const REST_API_VERSION = '1.0.7';
const PLUGDIR = "wp-rest-api";
function onactive (){
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-Acticate-RestApi-plugin.php';
    Morisfa_Activator::activate();
}
register_activation_hook( __FILE__, 'onactive' );


function ondeactive (){
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-Acticate-RestApi-plugin.php';
    Morisfa_Activator::deactivate();
}


register_deactivation_hook( __FILE__, 'ondeactive' );

function redirect_active( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=MorisfaRestApi' ) ) );
    }
}


add_action( 'activated_plugin', 'redirect_active' );


function morisfa_run (){
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-Enable-admin.php';
    require_once plugin_dir_path( __FILE__ ) . 'includes/admin/adminTheme.php';
$plugin = new Enable_admin ();
$plugin->run();
$plugin->register();



// register action to save setting data
    add_action('admin_post_submit-form', '_handle_form_action');
    function _handle_form_action(){ (new admin\adminTheme())->save_data();}

}
morisfa_run();

















