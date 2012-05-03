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

class TM_Highlight_Block_Review_New extends TM_Highlight_Block_Product_Abstract
{
    protected $_title = 'Recent reviews';
    protected $_priceSuffix = '-review';
    protected $_className = 'highlight-review';
    
    protected function _beforeToHtml()
    {
        $collection = $this->getCollection('review/review_product_collection')
            ->addStatusFilter(1);
        
        $collection->getSelect()->order('rt.created_at DESC');
        
        $this->setProductCollection($collection);
        
        return parent::_beforeToHtml();
    }
    
    public function getReviewUrl($id)
    {
        return Mage::getUrl('review/product/view', array('id' => $id));
    }
}