<?php

namespace Jet_Forms_PN;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Autoloader handler class is responsible for loading the different
 * classes needed to run the plugin.
 */
class Autoloader {

	/**
	 * Run autoloader.
	 *
	 * Register a function as `__autoload()` implementation.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 */
	private static $plugin_path;

	public static function run() {
		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}


	/**
	 * Load class.
	 *
	 * For a given class name, require the class file.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 *
	 * @param string $relative_class_name Class name.
	 */
	private static function load_class( $class_name ) {

		$file     = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name );
		$file     = strtolower( str_replace( '_', '-', $file ) );
		$filepath = JET_FORMS_POPUP_NOTIFICATION_PATH . 'includes/' . $file . '.php';

		if ( is_readable( $filepath ) ) {
			require $filepath;
		}
	}

	/**
	 * Autoload.
	 *
	 * For a given class, check if it exist and load it.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 *
	 * @param string $class Class name.
	 */
	private static function autoload( $class ) {

		if ( 0 !== strpos( $class, __NAMESPACE__ . '\\' ) ) {
			return;
		}

		$relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $class );
		$final_class_name    = __NAMESPACE__ . '\\' . $relative_class_name;

		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $relative_class_name );
		}

	}
}
