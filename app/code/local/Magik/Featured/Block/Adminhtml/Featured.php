<?php
class Magik_Featured_Block_Adminhtml_Featured extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_featured';
    $this->_blockGroup = 'featured';
    $this->_headerText = Mage::helper('featured')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('featured')->__('Add Item');
    parent::__construct();
  }
}