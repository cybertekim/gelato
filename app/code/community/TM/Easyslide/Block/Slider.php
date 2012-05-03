<?php

class TM_Easyslide_Block_Slider extends Mage_Core_Block_Template
{
    public function getTemplate()
    {
        if (!$this->hasData('template')) {
            $this->setData('template', 'easyslide/slider.phtml');
        }
        return $this->getData('template');
    }
    
    public function _toHtml()
    {
        if (!$this->_beforeToHtml() || !$sliderId = $this->getSliderId()) {
            return '';
        }
        $slider = Mage::getModel('easyslide/easyslide')->load($sliderId);
        if (!$slider->getStatus()) {
            return '';
        }
        $slider->loadSlides(true);
        $this->setSlider($slider);
        return parent::_toHtml();
    }
}
