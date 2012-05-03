<?php
class Magik_Featured_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/featured?id=15 
    	 *  or
    	 * http://site.com/featured/id/15 	
    	 */
    	/* 
		$featured_id = $this->getRequest()->getParam('id');

  		if($featured_id != null && $featured_id != '')	{
			$featured = Mage::getModel('featured/featured')->load($featured_id)->getData();
		} else {
			$featured = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($featured == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$featuredTable = $resource->getTableName('featured');
			
			$select = $read->select()
			   ->from($featuredTable,array('featured_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$featured = $read->fetchRow($select);
		}
		Mage::register('featured', $featured);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}