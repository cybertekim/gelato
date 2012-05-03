<?php

class TM_Easyslide_Model_Mysql4_Easyslide_Slides extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('easyslide/easyslide_slides', 'slide_id');
    }
}