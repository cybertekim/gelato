<?php

class Magik_Featured_Model_Featured extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('featured/featured');
    }
    
    /*
    * FUNCTION TO GET ALL THE FEATURED PRODUCTS 
    */
    public function getFeaturedProducts()
    {
    	$resource = Mage::getSingleton('core/resource');
		$read = $resource->getConnection('catalog_read');
		$productEntityIntTable = (string)Mage::getConfig()->getTablePrefix() . 'catalog_product_entity_int';
		$eavAttributeTable = $resource->getTableName('eav/attribute');
		$categoryProductTable = $resource->getTableName('catalog/category_product');
		$select = $read->select()
			->distinct(true)
			->from(array('cp'=>$categoryProductTable), 'product_id')
			->join(array('pei'=>$productEntityIntTable), 'pei.entity_id=cp.product_id', array())
			->joinNatural(array('ea'=>$eavAttributeTable))
			->where('pei.value=1')
			->where('ea.attribute_code="featured"');
		$res = $read->fetchAll($select);
		return $res;
	}
	
	/*
	* FUNCTION TO LOAD ALL THE IMAGES FROM THE TABLE
	*/
	function loadImages()
	{
		$resource = Mage::getSingleton('core/resource');
    	$read = $resource->getConnection('catalog_read');
    	$select = $read->select()
          ->from((string)Mage::getConfig()->getTablePrefix().'magik_featured_image');
		$result = $read->fetchAll($select);
        return $result;
	}
}