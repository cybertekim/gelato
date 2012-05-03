<?php

class Mageex_Onsale_Helper_Data extends Mage_Core_Helper_Abstract
{
    /*
    * the functions return  slider configuration
    */
    public function getEnableSlider(){
        return Mage::getStoreConfig('onsale/silder/en_slide');
    }
    
    public function getEnableLabel(){
        return Mage::getStoreConfig('onsale/silder/en_label');
    }
    
    public function getImgLabel(){
        return Mage::getStoreConfig('onsale/silder/img_label');
    }
    
    public function getDisBorder(){
        return Mage::getStoreConfig('onsale/silder/dis_border');
    }
    
    public function getBorderColor(){
        return Mage::getStoreConfig('onsale/silder/slider_border_color');
    }
    
    public function getMaxProductCount(){
        return Mage::getStoreConfig('onsale/silder/max_count');
    }
    
    public function getButtonStyle(){
        return Mage::getStoreConfig('onsale/silder/bt_style');
    }
    
    public function getEnableAutoSlider(){
        if(Mage::getStoreConfig('onsale/silder/en_auto') == 0)
		{
			return 'false';
		}
		return 'true';
    }
    
    public function getSliderEffect(){
        return Mage::getStoreConfig('onsale/silder/slider_effect');
    }
    
    public function getSliderDuration(){
        return Mage::getStoreConfig('onsale/silder/slide_duration');
    }
    
    /*
    * the functions return  product infomation settings
    */
    
    public function getImgSize(){
        return Mage::getStoreConfig('onsale/pro_settings/image_size');
    }
    
    public function getDisName(){
        return Mage::getStoreConfig('onsale/pro_settings/dis_name');
    }
    
    public function getNameFontsize(){
        return Mage::getStoreConfig('onsale/pro_settings/name_size');
    }
    
    public function getNameColor(){
        return Mage::getStoreConfig('onsale/pro_settings/name_color');
    }
    
    public function getDisDescription(){
        return Mage::getStoreConfig('onsale/pro_settings/dis_description');
    }
    
    public function getMaxWord(){
        return Mage::getStoreConfig('onsale/pro_settings/max_word');
    }
    
    public function getDisPrice(){
        return Mage::getStoreConfig('onsale/pro_settings/dis_price');
    }
    
    public function getPriceFontsize(){
        return Mage::getStoreConfig('onsale/pro_settings/price_fontsize');
    }
    
    public function getPriceColor(){
        return Mage::getStoreConfig('onsale/pro_settings/price_color');
    }
    
    public function getEnableAddToCard(){
        return Mage::getStoreConfig('onsale/pro_settings/en_button');
    }
    public function getDisListImg(){
        return Mage::getStoreConfig('onsale/pro_settings/dis_list');
    }
    
    public function getListImgSize(){
        return Mage::getStoreConfig('onsale/pro_settings/list_size');
    }
    
    public function getBackgroundCurrentImg(){
        return Mage::getStoreConfig('onsale/pro_settings/cur_img');
    }
    
}