<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?><?php

class Magazento_Firstslider_Block_Admin_Slide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {
    /**
     * Init form
     */
//    public function __construct()
//    {
//        parent::__construct();
//        $this->setId('edit_form12121');
//        $this->setTitle(Mage::helper('firstslider')->__('Slide Information'));
//    }

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareForm() {
        $model = Mage::registry('firstslider_slide');
        $form = new Varien_Data_Form(array('id' => 'edit_form_slide', 'action' => $this->getData('action'), 'method' => 'post'));
        $form->setHtmlIdPrefix('slide_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('firstslider')->__('General Information'), 'class' => 'fieldset-wide'));
        if ($model->getSlideId()) {
            $fieldset->addField('slide_id', 'hidden', array(
                'name' => 'slide_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('firstslider')->__('Title'),
            'title' => Mage::helper('firstslider')->__('Title'),
            'required' => true,
//            'style' => 'width:200px',
        ));



        $fieldset->addField('position', 'text', array(
            'name' => 'position',
            'label' => Mage::helper('firstslider')->__('Position'),
            'title' => Mage::helper('firstslider')->__('Position'),
            'required' => true,
        ));

        $categories = array();
        $collection = Mage::getModel('firstslider/category')->getCollection()->setOrder('name', 'asc');
        foreach ($collection as $cat) {
            $categories[] = ( array(
                'label' => (string) $cat->getName(),
                'value' => $cat->getCategoryId()
                    ));
        }
        $fieldset->addField('category_id', 'multiselect', array(
            'name' => 'category_id[]',
            'label' => Mage::helper('firstslider')->__('Category'),
            'title' => Mage::helper('firstslider')->__('Category'),
            'required' => true,
            'style' => 'height:100px',
            'values' => $categories,
        ));


        $fieldset->addField('is_active', 'select', array(
            'label' => Mage::helper('firstslider')->__('Status'),
            'title' => Mage::helper('firstslider')->__('Status'),
            'name' => 'is_active',
            'required' => true,
            'options' => array(
                '1' => Mage::helper('firstslider')->__('Enabled'),
                '0' => Mage::helper('firstslider')->__('Disabled'),
            ),
        ));

        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $fieldset->addField('from_time', 'date', array(
            'name' => 'from_time',
            'time' => true,
            'label' => Mage::helper('firstslider')->__('From Time'),
            'title' => Mage::helper('firstslider')->__('From Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));

        $fieldset->addField('to_time', 'date', array(
            'name' => 'to_time',
            'time' => true,
            'label' => Mage::helper('firstslider')->__('To Time'),
            'title' => Mage::helper('firstslider')->__('To Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));


        if (Mage::helper('firstslider')->versionUseWysiwig()) {
            $wysiwygConfig = Mage::getSingleton('firstslider/wysiwyg_config')->getConfig();
        } else {
            $wysiwygConfig = '';
        }

        $fieldset->addField('content', 'editor', array(
            'name' => 'content',
            'label' => Mage::helper('firstslider')->__('Content'),
            'title' => Mage::helper('firstslider')->__('Content'),
            'style' => 'height:36em',
            'config' => $wysiwygConfig,
            'required' => true,
        ));

        $fieldset->addField('script_java', 'note', array(
            'text' => '<script type="text/javascript">
				            var inputDateFrom = document.getElementById(\'slide_from_time\');
				            var inputDateTo = document.getElementById(\'slide_to_time\');
            				inputDateTo.onchange=function(){dateTestAnterior(this)};
				            inputDateFrom.onchange=function(){dateTestAnterior(this)};


				            function dateTestAnterior(inputChanged){
				            	dateFromStr=inputDateFrom.value;
				            	dateToStr=inputDateTo.value;

				            	if(dateFromStr.indexOf(\'.\')==-1)
				            		dateFromStr=dateFromStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");
				            	if(dateToStr.indexOf(\'.\')==-1)
				            		dateToStr=dateToStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");

				            	fromDate= Date.parseDate(dateFromStr,"%e %b %Y %H:%M:%S");
				            	toDate= Date.parseDate(dateToStr,"%e %b %Y %H:%M:%S");

				            	if(dateToStr!=\'\'){
					            	if(fromDate>toDate){
	            						inputChanged.value=\'\';
	            						alert(\'' . Mage::helper('firstslider')->__('You must set a date to value greater than the date from value') . '\');
					            	}
				            	}
            				}
            			</script>',
            'disabled' => true
        ));
//        print_r($model->getData());
//        exit();
//        $form->setUseContainer(true);
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
