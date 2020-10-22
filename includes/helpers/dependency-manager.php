<?php

namespace Jet_Forms_PN\Helpers;


class Dependency_Manager
{
    private $must_have;
    private $simple;

    private $is_all_present = true;
    private $simple_present = false;

    private $check_name_func    = 'check_exist';
    private $absent_name_func   = 'if_absent';

    public function check_dependencies() {

        $this->check_must_have_present();
        $this->check_simple_present();

        $this->show_simple_warnings();

        return ( $this->is_all_present && $this->simple_present );
    }

    private function check_must_have_present() {

        foreach ($this->must_have as $dependence ) {
            $func = $this->check_name_func;
            if ( is_callable( array( $dependence, $func ) ) && ! $dependence->$func() )
            {
                $func = $this->absent_name_func;
                if ( is_callable( array( $dependence, $func ) ) ) {
                    $dependence->$func();
                }
                $this->is_all_present = false;
            }
        }
    }

    private function check_simple_present() {
        foreach ( $this->simple as $dependence_simple ) {
            $func_check = $this->check_name_func;
            $func_absent = $this->absent_name_func;

            if ( is_callable( array( $dependence_simple, $func_check ) ) && $dependence_simple->$func_check() ) {

                $this->simple_present = true;
                $this->set_isset( $dependence_simple, true );

            } elseif ( is_callable( array( $dependence_simple, $func_absent ) ) ) {
                $dependence_simple->$func_absent();
            }
        }
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

    public function must_have( $dependencies_array ) {
        $this->must_have = $dependencies_array;
        return $this;
    }

    public function simple( $dependencies_array ) {
        $this->simple = $dependencies_array;
        $this->save_simple_variables();

        return $this;
    }

    public function save_simple_variables() {
        foreach ( $this->simple as $simple ) {
            $this->set_isset( $simple, false );
        }
    }

    private function set_isset( $depend, $value ) {
        $prop = 'isset_' . $depend->name;
        $this->$prop = $value;
    }




}