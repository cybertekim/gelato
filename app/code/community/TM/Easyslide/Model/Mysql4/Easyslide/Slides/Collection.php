<?php

class TM_Easyslide_Model_Mysql4_Easyslide_Slides_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('easyslide/easyslide_slides');
    }
}