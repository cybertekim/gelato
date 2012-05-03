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

class TM_Highlight_Block_Product_Attribute_Boolean extends TM_Highlight_Block_Product_Abstract
{
    protected function _beforeToHtml()
    {
        $collection = $this->getCollection();
        
        try {
            $collection->addAttributeToFilter("{$this->getAttributeCode()}", array('Yes' => true));
        } catch (Exception $e) {
            $collection = false;
        }
        
        $this->setProductCollection($collection);
        
        return parent::_beforeToHtml();
    }
    
}