<?php


namespace Jet_Forms_PN\Providers;


abstract class Provider_Base
{
    public $popups;

    abstract public function get_popups();

    public function prepare_popups() {
        $prepared_popups = array();

        foreach ( $this->popups as $id => $label ) {
            if ( ! $id ) {
                continue;
            }
            $prepared_popups[] = array(
                'value' => $id,
                'label' => $label
            );
        }

        return $prepared_popups;
    }

    public function get_result() {
        $this->get_popups();

        if ( empty( $this->popups ) ) {
            return array();
        }

        return $this->prepare_popups();
    }
}

