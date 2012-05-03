<?php
class Mageex_Onsale_Block_Onsale extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getOnsale()     
     { 
        $_productCollection = Mage::getResourceModel('catalog/product_collection')
                            ->addAttributeToSelect('name')
                            ->addAttributeToSelect('sku')
                            ->addAttributeToSelect('id')
                            ->addAttributeToSelect('image')
                            ->addAttributeToSelect('short_description')
                            ->addFieldToFilter('visibility', array('eq'=>4))
                            ->addFieldToFilter('status', 1)
                            ->addFieldToFilter('type_id', array('neq'=>'bundle'))
                            ->addAttributeToSelect('special_price', array('neq'=>NULL))
                            ->joinField('qty',
                            'cataloginventory/stock_item',
                            'qty',
                            'product_id=entity_id',
                            '{{table}}.stock_id=1',
                            'left');
        $proNumber = $this->helper('onsale')->getMaxProductCount();                   
        Mage::getModel('catalog/layer')->prepareProductCollection($_productCollection);
        $_productCollection->setPageSize($proNumber); 
                            
                            //echo  $col->getSelect()->__toString();
        $_productCollection->joinAttribute('price', 'catalog_product/price', 'entity_id', null, 'left', null);
        
        return $_productCollection;
        //Mage::register('productonsales',$_productCollection);
        /*if (!$this->hasData('onsale')) {
            $this->setData('onsale', Mage::registry('onsale'));
        }
        return $this->getData('onsale');*/
        
    }
}