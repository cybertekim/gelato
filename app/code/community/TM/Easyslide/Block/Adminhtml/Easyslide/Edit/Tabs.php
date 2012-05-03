<?php

class TM_Easyslide_Block_Adminhtml_Easyslide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('easyslide')->__('Slider information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main_section', array(
            'label'     => Mage::helper('easyslide')->__('General Information'),
            'title'     => Mage::helper('easyslide')->__('General Information'),
            'content'   => $this->getLayout()->createBlock('easyslide/adminhtml_easyslide_edit_tab_main')->toHtml(),
            'active'    => true
        ));
        
        $this->addTab('slide_section', array(
            'label'     => Mage::helper('easyslide')->__('Slides'),
            'title'     => Mage::helper('easyslide')->__('Slides'),
            'content'   => $this->getLayout()->createBlock('easyslide/adminhtml_easyslide_edit_tab_slides', 'easyslide.slides')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }

}
