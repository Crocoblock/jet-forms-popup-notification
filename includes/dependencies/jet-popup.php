<?php


namespace Jet_Forms_PN\Dependencies;


class Jet_Popup extends Dependence_Base
{
    public $name = 'jet_popup';

    public function check_exist() {
        return function_exists( 'jet_popup' );
    }

    public function if_absent() {

    }

}