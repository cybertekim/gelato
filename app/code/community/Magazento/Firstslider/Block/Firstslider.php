<?php

Class Magazento_Firstslider_Block_Firstslider extends Mage_Core_Block_Template {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('magazento/firstslider/slider.phtml');
    }

    public function getModel() {
        return Mage::getModel('firstslider/data');
    }

    //{{block type="firstslider/firstslider" category_id="1" name="firstslider"}}
}