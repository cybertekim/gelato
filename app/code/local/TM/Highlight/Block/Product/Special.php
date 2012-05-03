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

class TM_Highlight_Block_Product_Special extends TM_Highlight_Block_Product_Attribute_Date
{
    protected $_title = 'Special products';
    protected $_priceSuffix = '-special';
    protected $_attributeCode = 'special_from_date,special_to_date';
    protected $_className = 'highlight-special';
    
    protected function _beforeToHtml()
    {
        $this->addPriceFilter('special_price');
        return parent::_beforeToHtml();
    }
}