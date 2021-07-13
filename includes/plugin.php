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

		add_action(
			'after_setup_theme',
			array( $this, 'init_components' ), 0
		);

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'register_scripts' ), 999
		);
	}

	public function init_components() {
		$this->ajax         = new Ajax_Manager();
		$this->notification = new Notification();

		new Action_Manager();

	}

	public function register_scripts() {
		wp_add_inline_script( 'jquery', $this->show_popup_js(), 'after' );
	}

	public function show_popup_js() {
		$jet_popup = Providers_Manager::JET_POPUP_PROVIDER_NAME;
		$elementor = Providers_Manager::ELEMENTOR_PRO_PROVIDER_NAME;

		$redirect_data = json_encode( $this->parse_after_submit() );

		return "          
			function onAjaxSubmitSuccess( event, response, form, request ) {
                if ( typeof response.popup_data === 'undefined' ) {
                    return;
                }
                showPopup( response.popup_data );
            }
                          
            jQuery( document ).on( 'jet-engine/form/ajax/on-success', onAjaxSubmitSuccess );
            jQuery( document ).on( 'jet-form-builder/ajax/on-success', onAjaxSubmitSuccess )
                
            let popup_data = JSON.parse( '$redirect_data' );
                
			if ( popup_data ) {
                showPopup( popup_data, true );
			}     
			
			function triggerPopup( callback, hookName = '', is_reload = false ) {	
				if ( is_reload && hookName ) {
					jQuery( window ).on( hookName, callback ); 
				} else {
					callback();
				}
			}
            
            function showPopup( popup_data, is_reload = false ) {
                const provider = popup_data.provider;
                let popupId = popup_data.popup;
                
                if ( provider === '$jet_popup' ) {
                    popupId = 'jet-popup-' + popupId;
                    
                    const callback = () => {
                        jQuery( window ).trigger( {
							type: 'jet-popup-open-trigger',
	                        popupData: { popupId }
						} )
                    };
                    
                    triggerPopup( callback, 'jet-popup/init-events/after', is_reload );                   
                }
                else if( provider === '$elementor' ) {
                    const callback = () => {
	                    setTimeout( () => {
							if ( typeof elementorProFrontend === 'undefined' ) {
                                return;
                            }
                        
                            elementorProFrontend.modules.popup.showPopup( 
								{ id: popupId } 
							);
	                    }, 500 );                        
                    };                    
                    
                    triggerPopup( callback, 'elementor/frontend/init', is_reload );
                }
            }
        ";
	}

	public function check_dependencies() {
		$this->dependence_manager = new Dependency_Manager();

		$this->dependence_manager->must_have( array(
			new Jet_Engine()
		) )->simple( array(
			new Jet_Popup(),
			new Elementor_Pro()
		) );

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
	 *
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();