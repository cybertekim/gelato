<?php
class Magik_Featured_Block_Featured extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getFeatured()     
     { 
        if (!$this->hasData('featured')) {
            $this->setData('featured', Mage::registry('featured'));
        }
        return $this->getData('featured');
        
    }
}