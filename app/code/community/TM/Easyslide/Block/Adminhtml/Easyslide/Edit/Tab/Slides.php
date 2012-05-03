<?php

class TM_Easyslide_Block_Adminhtml_Easyslide_Edit_Tab_Slides extends Mage_Adminhtml_Block_Widget
{
    public function __construct()
    {
        parent::__construct();
        //$this->setShowGlobalIcon(true);
        $this->setTemplate('easyslide/slides.phtml');
    }
    
    public function _prepareLayout()
    {
         $this->setChild('add_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('easyslide')->__('Add New Slide'),
                    'class' => 'add',
                    'id'    => 'add_new_slide'
                ))
        );
        
        $this->setChild('slide_box',
            $this->getLayout()->createBlock('easyslide/adminhtml_easyslide_edit_tab_slides_slide')
        );       
         
        return parent::_prepareLayout();
    }
    
    public function getAddButtonHtml()
    {
        return $this->getChildHtml('add_button');
    }
    
    public function getSlideBoxHtml()
    {
        return $this->getChildHtml('slide_box');
    }
}
