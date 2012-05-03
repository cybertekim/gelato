<?php

class Magik_Featured_Model_Mysql4_Featured extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the featured_id refers to the key field in your database table.
        $this->_init('featured/featured', 'featured_id');
    }
}