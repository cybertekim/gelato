<?php

class Mageex_Onsale_Block_Adminhtml_Onsale_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'onsale';
        $this->_controller = 'adminhtml_onsale';
        
        $this->_updateButton('save', 'label', Mage::helper('onsale')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('onsale')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('onsale_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'onsale_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'onsale_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('onsale_data') && Mage::registry('onsale_data')->getId() ) {
            return Mage::helper('onsale')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('onsale_data')->getTitle()));
        } else {
            return Mage::helper('onsale')->__('Add Item');
        }
    }
}