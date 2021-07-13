<?php


namespace Jet_Forms_PN\Helpers;


class Ajax_Manager
{
	/**
	 * @var Providers_Manager
	 */
    public $manager;
    public $action = 'jet_pep_get_popups_by_provider';

    public function __construct() {
        $this->add_hooks();
    }

    public function add_hooks() {
        if ( ! wp_doing_ajax() ) {
            return;
        }

        add_action(
            "wp_ajax_{$this->action}",
            array( $this, 'get_popups_by_provider' )
        );
    }

    public function get_popups_by_provider() {
        if ( ! $this->set_provider() ) {
        	wp_send_json_error();
        }

        wp_send_json_success( array(
            'popups' => $this->manager->provider->get_result()
        ) );
    }

    public function set_provider() {
        if ( ! isset( $_GET['provider'] ) || empty( $_GET['provider'] ) ) {
            return false;
        }
        $this->manager = new Providers_Manager( $_GET['provider'] );

        if ( ! $this->manager->provider ) {
            return false;
        }

        return true;
    }

}