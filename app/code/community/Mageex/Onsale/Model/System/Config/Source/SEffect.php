<?php
class Mageex_Onsale_Model_System_Config_Source_SEffect{
    public function toOptionArray(){
        return array(
            array('value'=>'hslide','label'=>'horisontal slide'),
            array('value'=>'vslide','label'=>'vertical slide'),
            array('value'=>'fade','label'=>'fade')
        );
    }      
}