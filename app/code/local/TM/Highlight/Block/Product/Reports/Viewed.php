<?php
/**
 * This is the part of 'Highlight' module for Magento,
 * which allows easy access to product collection
 * with flexible filters
 * 
 * @author Templates-Master
 * @copyright 2008 - 2009 Templates Master www.templates-master.com
 * @version 1.1.1
 */

class TM_Highlight_Block_Product_Reports_Viewed extends Mage_Reports_Block_Product_Viewed
{
    protected function _hasViewedProductsBefore()
    {
        return true;
    }
}
