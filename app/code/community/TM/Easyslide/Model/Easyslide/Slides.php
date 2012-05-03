<?php

class TM_Easyslide_Model_Easyslide_Slides extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('easyslide/easyslide_slides');
    }
}