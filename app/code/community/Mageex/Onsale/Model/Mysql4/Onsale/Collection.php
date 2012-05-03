<?php

class Mageex_Onsale_Model_Mysql4_Onsale_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('onsale/onsale');
    }
}