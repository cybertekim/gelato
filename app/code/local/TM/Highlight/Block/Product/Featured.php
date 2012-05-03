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

class TM_Highlight_Block_Product_Featured extends TM_Highlight_Block_Product_Attribute_Boolean
{
    protected $_title = 'Featured Products';
    protected $_priceSuffix = '-featured';
    protected $_attributeCode = 'featured';
    protected $_className = 'highlight-featured';
}