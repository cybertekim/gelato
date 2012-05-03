<?php

class Magik_Featured_Model_Mysql4_Featured_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('featured/featured');
    }
}