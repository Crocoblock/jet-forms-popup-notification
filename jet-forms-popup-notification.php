<?php
/**
 * Plugin Name: JetEngine Forms - popup notification
 * Plugin URI:
 * Description: Also supports JetFormBuilder.
 * Version:     1.1.6
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-forms-popup-notification
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die();
}

add_action( 'plugins_loaded', 'jet_forms_popup_notification' );

function jet_forms_popup_notification() {

    define( 'JET_FORMS_POPUP_NOTIFICATION_VERSION', '1.1.6' );

    define( 'JET_FORMS_POPUP_NOTIFICATION__FILE__', __FILE__ );
    define( 'JET_FORMS_POPUP_NOTIFICATION_PLUGIN_BASE', plugin_basename( JET_FORMS_POPUP_NOTIFICATION__FILE__ ) );
    define( 'JET_FORMS_POPUP_NOTIFICATION_PATH', plugin_dir_path( JET_FORMS_POPUP_NOTIFICATION__FILE__ ) );
    define( 'JET_FORMS_POPUP_NOTIFICATION_URL', plugins_url( '/', JET_FORMS_POPUP_NOTIFICATION__FILE__ ) );

    require JET_FORMS_POPUP_NOTIFICATION_PATH . 'includes' . DIRECTORY_SEPARATOR . 'plugin.php';
}
