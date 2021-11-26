<?php

namespace Jet_Forms_PN;

use Jet_Forms_PN\Dependencies\Elementor_Pro;
use Jet_Forms_PN\Dependencies\Jet_Engine;
use Jet_Forms_PN\Dependencies\Jet_Popup;
use Jet_Forms_PN\Helpers\Providers_Manager;
use Jet_Forms_PN\Helpers\Ajax_Manager;
use Jet_Forms_PN\Helpers\Dependency_Manager;
use Jet_Forms_PN\Jet_Form_Builder\Action_Manager;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	public $notification;
	/**
	 * @var Ajax_Manager
	 */
	public $ajax;

	public $slug = 'jet-forms-popup-notification';

	public $dependence_manager;

	public $isset_jet_popup = true;
	public $isset_elementor_pro = true;

	private function __construct() {

		$this->register_autoloader();

		if ( ! $this->check_dependencies() ) {
			return;
		}

		if ( ! function_exists( 'jet_engine' ) && ! function_exists( 'jet_form_builder' ) ) {
			add_action(
				'admin_notices',
				function () {
					$class   = 'notice notice-error';
					$message = __(
						'<b>WARNING!</b> <b>JetForms Popup Notification</b> plugin requires <b>JetEngine</b> or JetFormBuilder plugin to work properly!',
						'jet-forms-popup-notification'
					);
					printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
				}
			);

			return;
		}

		add_action(
			'after_setup_theme',
			array( $this, 'init_components' ),
			0
		);

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'register_scripts' ),
			999
		);
	}

	public function init_components() {
		$this->ajax         = new Ajax_Manager();
		$this->notification = new Notification();

		new Action_Manager();

	}

	public function register_scripts() {
		wp_enqueue_script(
			$this->slug,
			$this->plugin_url( 'assets/js/frontend.js' ),
			array( 'jquery' ),
			$this->get_version(),
			true
		);

		wp_localize_script( $this->slug, 'JetFormPopupActionData', array(
			'jet_popup'     => Providers_Manager::JET_POPUP_PROVIDER_NAME,
			'elementor_pro' => Providers_Manager::ELEMENTOR_PRO_PROVIDER_NAME,
			'data'          => $this->parse_after_submit(),
		) );
	}

	public function check_dependencies() {
		$this->dependence_manager = new Dependency_Manager();

		$this->dependence_manager->simple(
			array(
				new Jet_Popup(),
				new Elementor_Pro(),
			)
		);

		return $this->dependence_manager->check_dependencies();
	}

	public function parse_after_submit() {
		if ( ! isset( $_GET['status'] )
		     || $_GET['status'] !== 'success'
		     || ! isset( $_GET['popup_data'] )
		     || ! $_GET['popup_data']
		) {
			return '[]';
		}

		$fields = $_GET['popup_data'];

		if ( ! in_array( $fields['provider'], Providers_Manager::enable_providers() )
		     || ! is_numeric( $fields['popup'] )
		) {
			return '[]';
		}

		return $fields;
	}

	/**
	 * Register autoloader.
	 */
	public function register_autoloader() {
		require JET_FORMS_POPUP_NOTIFICATION_PATH . 'includes/autoloader.php';
		Autoloader::run();
	}


	public function get_template_path( $template ) {
		$path = JET_FORMS_POPUP_NOTIFICATION_PATH . 'templates' . DIRECTORY_SEPARATOR;

		return ( $path . $template . '.php' );
	}

	public function get_version() {
		return JET_FORMS_POPUP_NOTIFICATION_VERSION;
	}

	public function plugin_url( $path ) {
		return JET_FORMS_POPUP_NOTIFICATION_URL . $path;
	}

	public function url_assets_js( $path ) {
		return $this->plugin_url( 'assets/js/' . $path . '.js' );
	}

	public function url_assets_css( $path ) {
		return $this->plugin_url( 'assets/css/' . $path . '.css' );
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();
