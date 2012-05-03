<?php

class Magik_Featured_Block_Adminhtml_Featured_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('featured_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('featured')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('featured')->__('Item Information'),
          'title'     => Mage::helper('featured')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('featured/adminhtml_featured_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}