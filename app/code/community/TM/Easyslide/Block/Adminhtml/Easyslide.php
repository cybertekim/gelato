<?php
class TM_Easyslide_Block_Adminhtml_Easyslide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_easyslide';
        $this->_blockGroup = 'easyslide';
        $this->_headerText = Mage::helper('easyslide')->__('Manage Sliders');
        $this->_addButtonLabel = Mage::helper('easyslide')->__('Add Slider');
        parent::__construct();
    }
}