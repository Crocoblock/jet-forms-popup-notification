<?php


namespace Jet_Forms_PN\Dependencies;


class Jet_Engine
{
    public $name = 'jet_engine';

    public function check_exist() {
        return function_exists( 'jet_engine' );
    }

    public function if_absent() {

        add_action( 'admin_notices', function() {
            $class = 'notice notice-error';
            $message = __( '<b>WARNING!</b> <b>JetForms Popup Notification</b> plugin requires <b>JetEngine</b> plugin to work properly!',
                'jet-forms-popup-notification' );
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
        } );
    }

}