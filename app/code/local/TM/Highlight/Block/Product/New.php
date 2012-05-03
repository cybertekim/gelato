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

class TM_Highlight_Block_Product_New extends TM_Highlight_Block_Product_Attribute_Date
{
    protected $_title = 'New Products';
    protected $_priceSuffix = '-new';
    protected $_attributeCode = 'news_from_date,news_to_date';
    protected $_className = 'highlight-new';
}