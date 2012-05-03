<?php

class Mageex_Onsale_Model_Mysql4_Onsale extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the onsale_id refers to the key field in your database table.
        $this->_init('onsale/onsale', 'onsale_id');
    }
}