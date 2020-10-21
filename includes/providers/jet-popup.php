<?php

namespace Jet_Forms_PN\Providers;

class Jet_Popup extends Provider_Base
{

    public function get_popups()
    {
        $this->popups = \Jet_Popup_Utils::get_avaliable_popups();

        return $this;
    }

}