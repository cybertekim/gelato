<?php
class Mageex_Onsale_Block_Adminhtml_Onsale extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_onsale';
    $this->_blockGroup = 'onsale';
    $this->_headerText = Mage::helper('onsale')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('onsale')->__('Add Item');
    parent::__construct();
  }
}