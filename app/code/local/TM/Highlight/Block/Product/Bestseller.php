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

class TM_Highlight_Block_Product_Bestseller extends TM_Highlight_Block_Product_Abstract
{
    protected $_title = 'Bestsellers';
    protected $_priceSuffix = '-bestseller';
    protected $_className = 'highlight-bestseller';
    
    protected function _beforeToHtml()
    {
        $collection = $this->getCollection('highlight/reports_product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('ordered_qty')
            ->setOrder('ordered_qty', 'desc');
        
        $this->setProductCollection($collection);

        return parent::_beforeToHtml();
    } 
}