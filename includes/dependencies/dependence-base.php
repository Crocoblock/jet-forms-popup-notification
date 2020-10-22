<?php

namespace Jet_Forms_PN\Dependencies;


abstract class Dependence_Base
{
    public $name;

    abstract public function check_exist();

    abstract public function if_absent();

}