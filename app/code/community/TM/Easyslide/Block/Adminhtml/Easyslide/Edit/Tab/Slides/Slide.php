<?php

class TM_Easyslide_Block_Adminhtml_Easyslide_Edit_Tab_Slides_Slide extends Mage_Adminhtml_Block_Widget
{
    protected $_product;
    protected $_sliderInstance;
    protected $_name = 'slides';
    protected $_id = 'slide';
    protected $_values;
    protected $_itemCount = 1;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easyslide/slides/slide.phtml');
    }

    public function getItemCount()
    {
        return $this->_itemCount;
    }

    public function setItemCount($itemCount)
    {
        $this->_itemCount = max($this->_itemCount, $itemCount);
        return $this;
    }

    /**
     * @return TM_Easyslide_Model_Easyslide
     */
    public function getSlider()
    {
        if (!$this->_sliderInstance) {
            if ($slider = Mage::registry('slider')) {
                $this->_sliderInstance = $slider;
            } else {
                $this->_sliderInstance = Mage::getSingleton('easyslide/easyslide');
            }
        }
        return $this->_sliderInstance;
    }

    public function getFieldName()
    {
        return $this->_name;
    }

    public function getFieldId()
    {
        return $this->_id;
    }

    protected function _prepareLayout()
    {
        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('easyslide')->__('Delete Slide'),
                    'class' => 'delete delete-slide'
                ))
        );
        return parent::_prepareLayout();
    }

    public function getAddButtonId()
    {
        $buttonId = $this->getLayout()
                ->getBlock('easyslide.slides')
                ->getChild('add_button')->getId();
        return $buttonId;
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }
    
    public function getIsEnabledSelectHtml()
    {
        $select = $this->getLayout()->createBlock('adminhtml/html_select')
            ->setData(array(
                'id' => $this->getFieldId().'_{{slide_id}}_is_enabled',
                'class' => 'select'
            ))
            ->setName($this->getFieldName().'[{{slide_id}}][is_enabled]')
            ->setOptions(Mage::getSingleton('adminhtml/system_config_source_yesno')
            ->toOptionArray());

        return $select->getHtml();
    }

    public function getSlideValues()
    {
        $slidesArr = array_reverse($this->getSlider()->getSlides());
        if (!$this->_values) {
            $values = array();
            foreach ($slidesArr as $slide) {
                $this->setItemCount($slide['slide_id']);
                $value = array();
                $value['slide_id'] = $slide['slide_id'];
                $value['slider_id'] = $slide['slider_id'];
                $value['description'] = $slide['description'];
                $value['url'] = $slide['url'];
                $value['target'] = $slide['target'];
                $value['image'] = $slide['image'];
                $value['sort_order'] = $slide['sort_order'];
                $value['is_enabled'] = $slide['is_enabled'];
                $value['item_count'] = $this->getItemCount();
                $values[] = new Varien_Object($value);
            }
            $this->_values = $values;
        }
        return $this->_values;
    }

}