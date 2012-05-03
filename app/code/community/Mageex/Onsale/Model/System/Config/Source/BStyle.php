<?php
class Mageex_Onsale_Model_System_Config_Source_BStyle{
    public function toOptionArray(){
        return array(
            array('value'=>'', 'label'=>Mage::helper('onsale')->__('Black')),
           	array('value'=>'blue', 'label'=>Mage::helper('onsale')->__('Blue')),
			array('value'=>'magenta', 'label'=>Mage::helper('onsale')->__('Magenta')),
           	array('value'=>'red', 'label'=>Mage::helper('onsale')->__('Red')),
			array('value'=>'orange', 'label'=>Mage::helper('onsale')->__('Orange')),
           	array('value'=>'yellow', 'label'=>Mage::helper('onsale')->__('Yellow')),	
			array('value'=>'green', 'label'=>Mage::helper('onsale')->__('Green')),
		    );
    }    
}