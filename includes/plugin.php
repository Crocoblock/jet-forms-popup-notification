<?php

namespace Jet_Forms_PN;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die();
}

class Plugin
{
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
    private $dependencies_must_have;
    private $dependencies_simple;

    public $notification;

    public $slug = 'jet-forms-popup-notification';

    public $isset_jet_popup = true;
    public $isset_elementor_pro = true;

    private function __construct() {

        if( ! $this->check_dependencies() ) {
            return;
        }
        $this->register_autoloader();

        add_action(
            'after_setup_theme',
            array( $this, 'init_components' ), 0
        );

        add_action(
            'wp_enqueue_scripts',
            array( $this, 'register_scripts' ), 99999
        );
    }

    public function init_components() {
        new Ajax_Manager();
        $this->notification = new Notification();
    }

    public function register_scripts() {
        wp_add_inline_script( 'jet-engine-frontend-forms', $this->show_popup_js(), 'after' );
    }

    public function show_popup_js() {
        $jet_popup = Providers_Manager::JET_POPUP_PROVIDER_NAME;
        $elementor = Providers_Manager::ELEMENTOR_PRO_PROVIDER_NAME;

        $redirect_data = json_encode( $this->parse_after_submit() );

        return "                        
            jQuery( document ).on( 'jet-engine/form/ajax/on-success', function( event, response, form, request ) {
                if ( typeof response.popup_data === 'undefined' ) {
                    return;
                }
                showPopup( response.popup_data );
            } );
            
            document.addEventListener( 'DOMContentLoaded', () => {
                let popup_data = JSON.parse( '$redirect_data' );
                
                if ( popup_data ) {
                    showPopup( popup_data );
                }
            } );
            
            
            function showPopup( popup_data ) {
                const provider = popup_data.provider;
                let popupId = popup_data.popup;
                
                if ( provider === '$jet_popup' ) {
                    popupId = 'jet-popup-' + popupId;
                     
                    jQuery( window ).trigger( {
                        type: 'jet-popup-open-trigger',
                        popupData: {
                            popupId: popupId,
                        }
                    } );
                }
                else if( provider === '$elementor' && elementorProFrontend !== 'undefined' ) {
                    elementorProFrontend.modules.popup.showPopup( 
                        { id: popupId } 
                    );
                }
            }
        ";
    }

    public function parse_after_submit() {
        if ( empty( $_GET ) || $_GET['status'] !== 'success' ) {
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

    private function dependencies() {
        $this->dependencies_must_have  = array(
            'jet_engine' => array(
                'check_exist'   => array( $this, 'jet_engine_check' ),
                'if_absent'     => array( $this, 'jet_engine_absent' ),
            ),
        );

        $this->dependencies_simple = array(
            'jet_popup' => array(
                'check_exist'   => array( $this, 'jet_popup_check' ),
                'if_absent'     => array( $this, 'jet_popup_absent' ),
            ),
            'elementor_pro' => array(
                'check_exist'   => array( $this, 'elementor_pro_check' ),
                'if_absent'     => array( $this, 'elementor_pro_absent' ),
            )
        );
    }

    public function elementor_pro_check() {
        return defined( 'ELEMENTOR_PRO_VERSION' );
    }
    public function elementor_pro_absent() {
        $this->isset_elementor_pro = false;
    }


    private function jet_engine_check() {
        return function_exists( 'jet_engine' );
    }
    private function jet_engine_absent() {
        $this->isset_elementor_pro = false;

        add_action( 'admin_notices', function() {
            $class = 'notice notice-error';
            $message = __( '<b>WARNING!</b> <b>JetForms Popup Notification</b> plugin requires <b>JetEngine</b> plugin to work properly!',
                'jet-forms-popup-notification' );
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
        } );
    }

    private function jet_popup_check() {
        return function_exists( 'jet_popup' );
    }

    private function jet_popup_absent() {
        $this->isset_jet_popup = false;
    }

    public function show_simple_warnings() {
        if ( $this->isset_elementor_pro || $this->isset_jet_popup ) {
            return;
        }
        add_action( 'admin_notices', function() {
            $class = 'notice notice-error';
            $message = __( '<b>WARNING!</b> <b>JetForms Popup Notification</b> plugin requires <b>JetPopup</b> or <b>Elementor Pro</b> plugin to work properly!',
                'jet-forms-popup-notification' );
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
        } );
    }

    private function check_dependencies() {
        $this->dependencies();

        $is_all_present = true;

        foreach ($this->dependencies_must_have as $dependence ) {
            if ( is_callable( $dependence[ 'check_exist' ] )
                && ! $dependence[ 'check_exist' ]() )
            {
                if ( is_callable( $dependence[ 'if_absent' ] ) ) {
                    $dependence[ 'if_absent' ]();
                }
                $is_all_present = false;
            }
        }

        $simple_present = false;
        foreach ( $this->dependencies_simple as $dependence_simple ) {
            if ( is_callable( $dependence_simple['check_exist'] )
                && $dependence_simple[ 'check_exist' ]() ) {

                $simple_present = true;

            } elseif ( is_callable( $dependence_simple[ 'if_absent' ] ) ) {

                $dependence_simple[ 'if_absent' ]();
            }
        }
        $this->show_simple_warnings();

        return ( $is_all_present && $simple_present );
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
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Plugin::instance();