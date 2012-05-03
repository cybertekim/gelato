<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?><?php

class Magazento_Firstslider_Block_Admin_Slide_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('FirstsliderGrid');
        $this->setDefaultSort('position');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('firstslider/slide')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $baseUrl = $this->getUrl();
        $this->addColumn('slide_id', array(
            'header' => Mage::helper('firstslider')->__('ID'),
            'align' => 'left',
            'width' => '30px',
            'index' => 'slide_id',
        ));
        $this->addColumn('position', array(
            'header' => Mage::helper('firstslider')->__('Position'),
            'align' => 'left',
            'index' => 'position',
            'width' => '30px',
        ));
        $this->addColumn('title', array(
            'header' => Mage::helper('firstslider')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $categories = array();
        $collection = Mage::getModel('firstslider/category')->getCollection()->setOrder('name', 'asc');
        foreach ($collection as $cat) {
            $categories[$cat->getCategoryId()] = $cat->getName();
        }

        $this->addColumn('category_id', array(
            'header' => Mage::helper('firstslider')->__('Category'),
            'align' => 'left',
            'index' => 'category_id',
            'sortable' => false,
            'type' => 'options',
            'options' => $categories,
            'filter_condition_callback' => array($this, '_filterCategoryCondition'),
        ));

        $this->addColumn('is_active', array(
            'header' => Mage::helper('firstslider')->__('Status'),
            'index' => 'is_active',
            'type' => 'options',
            'options' => array(
                0 => Mage::helper('firstslider')->__('Disabled'),
                1 => Mage::helper('firstslider')->__('Enabled'),
            ),
        ));

        $this->addColumn('from_time', array(
            'header' => Mage::helper('firstslider')->__('From Time'),
            'index' => 'from_time',
            'type' => 'datetime',
        ));

        $this->addColumn('to_time', array(
            'header' => Mage::helper('firstslider')->__('To Time'),
            'index' => 'to_time',
            'type' => 'datetime',
        ));

        $this->addColumn('action',
                array(
                    'header' => Mage::helper('firstslider')->__('Action'),
                    'index' => 'slide_id',
                    'sortable' => false,
                    'filter' => false,
                    'no_link' => true,
                    'width' => '200px',
                    'renderer' => 'firstslider/admin_slide_grid_renderer_action'
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('firstslider')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('firstslider')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _afterLoadCollection() {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterCategoryCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addCategoryFilter($value);
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('massaction');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('firstslider')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('firstslider')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('firstslider')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('firstslider')->__('Status'),
                    'values' => array(
                        0 => Mage::helper('firstslider')->__('Disabled'),
                        1 => Mage::helper('firstslider')->__('Enabled'),
                    ),
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('slide_id' => $row->getId()));
    }

}
