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

class TM_Highlight_Block_Product_Attribute_Date extends TM_Highlight_Block_Product_Abstract
{
    protected function _beforeToHtml()
    {
        $code_parts = explode(',', $this->getAttributeCode());
        if (count($code_parts) < 2) {
            throw new Exception(__("Invalid attribute format ({$this->_attributeCode}). Accepted format sample: 'news_from_date,news_to_date'"));
        }
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        $collection = $this->getCollection()
            ->addAttributeToFilter("{$code_parts[0]}", array('date' => true, 'to' => $todayDate))
            ->addAttributeToFilter("{$code_parts[1]}", array('or'=> array(
                0 => array('date' => true, 'from' => $todayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToSort("{$code_parts[0]}", 'desc');
            
        $this->setProductCollection($collection);

        return parent::_beforeToHtml();
    }

}