<?php

class TM_Easyslide_Block_Adminhtml_Easyslide_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('slider');
        
        $form = new Varien_Data_Form();
        
        $form->setHtmlIdPrefix('easyslide_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('easyslide')->__('General Information'), 'class' => 'fieldset-wide'));
        
        if ($model->getEasyslideId()) {
        	$fieldset->addField('easyslide_id', 'hidden', array(
                'name' => 'easyslide_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('easyslide')->__('Title'),
            'title'     => Mage::helper('easyslide')->__('Title'),
            'required'  => true
        ));
        
        $fieldset->addField('identifier', 'text', array(
            'name'      => 'identifier',
            'label'     => Mage::helper('easyslide')->__('Identifier'),
            'title'     => Mage::helper('easyslide')->__('Identifier'),
            'required'  => true
        ));
        
        $fieldset->addField('controls_type', 'select', array(
            'label'     => Mage::helper('easyslide')->__('Controls type'),
            'title'     => Mage::helper('easyslide')->__('Controls type'),
            'name'      => 'controls_type',
            'required'  => true,
            'options'   => array(
                'number' => Mage::helper('easyslide')->__('Numbers'),
                'arrow' => Mage::helper('easyslide')->__('Arrows')
            )
        ));
        
        $fieldset->addField('width', 'text', array(
            'name'      => 'width',
            'label'     => Mage::helper('easyslide')->__('Width'),
            'title'     => Mage::helper('easyslide')->__('Width'),
            'required'  => true
        ));
        
        $fieldset->addField('height', 'text', array(
            'name'      => 'height',
            'label'     => Mage::helper('easyslide')->__('Height'),
            'title'     => Mage::helper('easyslide')->__('Height'),
            'required'  => true
        ));
        
        $fieldset->addField('duration', 'text', array(
            'name'      => 'duration',
            'label'     => Mage::helper('easyslide')->__('Duration'),
            'title'     => Mage::helper('easyslide')->__('Duration'),
            'required'  => true
        ));
        
        $fieldset->addField('frequency', 'text', array(
            'name'      => 'frequency',
            'label'     => Mage::helper('easyslide')->__('Frequency'),
            'title'     => Mage::helper('easyslide')->__('Frequency'),
            'required'  => true
        ));
        
        $fieldset->addField('autoglide', 'select', array(
            'label'     => Mage::helper('easyslide')->__('Autoglide'),
            'title'     => Mage::helper('easyslide')->__('Autoglide'),
            'name'      => 'autoglide',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('easyslide')->__('Enabled'),
                '0' => Mage::helper('easyslide')->__('Disabled')
            )
        ));
        
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('easyslide')->__('Status'),
            'title'     => Mage::helper('easyslide')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('easyslide')->__('Enabled'),
                '0' => Mage::helper('easyslide')->__('Disabled')
            )
        ));

        $form->setValues($model->getData());
 
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
