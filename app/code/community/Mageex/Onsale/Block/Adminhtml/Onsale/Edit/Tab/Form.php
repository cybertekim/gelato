<?php

class Mageex_Onsale_Block_Adminhtml_Onsale_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('onsale_form', array('legend'=>Mage::helper('onsale')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('onsale')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('onsale')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('onsale')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('onsale')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('onsale')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('onsale')->__('Content'),
          'title'     => Mage::helper('onsale')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getOnsaleData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getOnsaleData());
          Mage::getSingleton('adminhtml/session')->setOnsaleData(null);
      } elseif ( Mage::registry('onsale_data') ) {
          $form->setValues(Mage::registry('onsale_data')->getData());
      }
      return parent::_prepareForm();
  }
}