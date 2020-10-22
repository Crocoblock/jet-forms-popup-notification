<?php


namespace Jet_Forms_PN\Dependencies;


class Elementor_Pro extends Dependence_Base
{
    public $name = 'elementor_pro';

    public function check_exist() {
        return defined( 'ELEMENTOR_PRO_VERSION' );
    }

    public function if_absent() {

    }

}