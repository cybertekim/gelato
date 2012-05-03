<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?><?php

class Magazento_Firstslider_Block_Admin_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
    	$this->_objectId = 'category_id';
        $this->_controller = 'admin_category';
        $this->_blockGroup = 'firstslider';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('firstslider')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('firstslider')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('firstslider')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        

        $this->_formScripts[] = "
           function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }
            
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            
        ";
    }

    /**
     * En-tete du formulaire d'édition
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('firstslider_category')->getId()) {
            return Mage::helper('firstslider')->__("Edit Category '%s'", $this->htmlEscape(Mage::registry('firstslider_category')->getName()));
        }
        else {
            return Mage::helper('firstslider')->__('New Slide');
        }
    }

}
