<?php


namespace Jet_Forms_PN\Helpers;

use Jet_Forms_PN\Plugin;
use Jet_Forms_PN\Providers\Provider_Base;


class Providers_Manager
{
    const ELEMENTOR_PRO_PROVIDER_NAME = 'elementor_pro';
    const JET_POPUP_PROVIDER_NAME = 'jet_popup';

	/**
	 * @var Provider_Base
	 */
    public $provider;

    public function __construct( $provider ) {
        $this->set_provider( $provider );
    }

    public static function get_providers() {
        $providers = array();

        if ( Plugin::instance()->dependence_manager->isset_jet_popup ) {
            $providers[] = array(
                'label' => 'JetPopup',
                'value' => self::JET_POPUP_PROVIDER_NAME,
            );
        }
        if ( Plugin::instance()->dependence_manager->isset_elementor_pro ) {
            $providers[] = array(
                'label' => 'Elementor Pro',
                'value' => self::ELEMENTOR_PRO_PROVIDER_NAME,
            );
        }

        return $providers;
    }

    public function make_class_name( $provider ) {
        $provider_class = explode( '_', $provider );

        foreach ($provider_class as $key => $value) {
            $provider_class[ $key ] = ucfirst( $value );
        }

        return implode( '_', $provider_class );
    }

    public static function enable_providers() {
        $providers = array();

        if ( Plugin::instance()->dependence_manager->isset_jet_popup ) {
            $providers[] = self::JET_POPUP_PROVIDER_NAME;
        }
        if ( Plugin::instance()->dependence_manager->isset_elementor_pro ) {
            $providers[] = self::ELEMENTOR_PRO_PROVIDER_NAME;
        }

        return $providers;
    }

    public function set_provider( $provider ) {
        if ( in_array( $provider, $this->enable_providers() ) ) {

            $class_name = 'Jet_Forms_PN\\Providers\\' . $this->make_class_name( $provider );

            $this->provider = new $class_name();
        }
    }

}

