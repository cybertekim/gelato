<?php

class Magik_Featured_Block_Adminhtml_Featured_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('featured_form', array('legend'=>Mage::helper('featured')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('featured')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('featured')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('featured')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('featured')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('featured')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('featured')->__('Content'),
          'title'     => Mage::helper('featured')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getFeaturedData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getFeaturedData());
          Mage::getSingleton('adminhtml/session')->setFeaturedData(null);
      } elseif ( Mage::registry('featured_data') ) {
          $form->setValues(Mage::registry('featured_data')->getData());
      }
      return parent::_prepareForm();
  }
}