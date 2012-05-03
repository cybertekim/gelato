<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?><?php

class Magazento_Firstslider_Block_Admin_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('FirstsliderGrid');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('firstslider/category')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $baseUrl = $this->getUrl();
        $this->addColumn('category_id', array(
            'header' => Mage::helper('firstslider')->__('ID'),
            'align' => 'left',
            'width' => '30px',
            'index' => 'category_id',
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper('firstslider')->__('Name'),
            'align' => 'left',
            'index' => 'name',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('firstslider')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }

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
                    'index' => 'category_id',
                    'sortable' => false,
                    'filter' => false,
                    'no_link' => true,
                    'width' => '200px',
                    'renderer' => 'firstslider/admin_category_grid_renderer_action'
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('firstslider')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('firstslider')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _afterLoadCollection() {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('category_id');
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
        return $this->getUrl('*/*/edit', array('category_id' => $row->getId()));
    }

}
