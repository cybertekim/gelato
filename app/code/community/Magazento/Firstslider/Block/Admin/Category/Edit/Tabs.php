<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?><?php

class Magazento_Firstslider_Block_Admin_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('firstslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('firstslider')->__('Item Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('firstslider')->__('Item Information'),
            'title' => Mage::helper('firstslider')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('firstslider/admin_category_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}