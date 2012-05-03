<?php

class Magik_Featured_Block_Adminhtml_Featured_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'featured';
        $this->_controller = 'adminhtml_featured';
        
        $this->_updateButton('save', 'label', Mage::helper('featured')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('featured')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('featured_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'featured_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'featured_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('featured_data') && Mage::registry('featured_data')->getId() ) {
            return Mage::helper('featured')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('featured_data')->getTitle()));
        } else {
            return Mage::helper('featured')->__('Add Item');
        }
    }
}