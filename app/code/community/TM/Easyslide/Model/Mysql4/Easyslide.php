<?php

class TM_Easyslide_Model_Mysql4_Easyslide extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('easyslide/easyslide', 'easyslide_id');
    }
    
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        // saving slides
        if (is_array($object->getData('slides'))) {
            foreach ($object->getData('slides') as $slide) {
                $slide_model = Mage::getModel('easyslide/easyslide_slides');
                
                $slide['slider_id'] = $object->getEasyslideId();
                
                if (isset($slide['slide_id']) && !empty($slide['slide_id'])) {
                    $slide_model->setId($slide['slide_id']);
                } else {
                    unset($slide['slide_id']);
                }
                
                if (isset($slide['is_delete']) && $slide['is_delete'] == 1) {
                    $slide_model->delete();
                } else {
                    $slide_model->setData($slide)->save();
                }
            }
        }
        
        return $this;
    }
}