<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Firstslider_Model_Mysql4_Slide extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct() {
        $this->_init('firstslider/slide', 'slide_id');
    }

    protected function _beforeSave(Mage_Core_Model_Abstract $object) {
        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        if (!$object->getFromTime()) {
            $object->setFromTime(Mage::getSingleton('core/date')->gmtDate());
        } else {
            $object->setFromTime(Mage::app()->getLocale()->date($object->getFromTime(), $dateFormatIso));
            $object->setFromTime($object->getFromTime()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT));
            $object->setFromTime(Mage::getSingleton('core/date')->gmtDate(null, $object->getFromTime()));
        }
        if (!$object->getToTime()) {
            $object->setToTime();
        } else {
            $object->setToTime(Mage::app()->getLocale()->date($object->getToTime(), $dateFormatIso));
            $object->setToTime($object->getToTime()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT));
            $object->setToTime(Mage::getSingleton('core/date')->gmtDate(null, $object->getToTime()));
        }
        return $this;
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $condition = $this->_getWriteAdapter()->quoteInto('slide_id = ?', $object->getId());
        $this->_getWriteAdapter()->delete($this->getTable('firstslider/slide_category'), $condition);
        if (!$object->getData('category')) {
            $object->setData('category', $object->getData('category_id'));
        }
        if (in_array(0, $object->getData('category'))) {
            $object->setData('category', array(0));
        }
        foreach ((array) $object->getData('category') as $store) {
            $storeArray = array();
            $storeArray['slide_id'] = $object->getId();
            $storeArray['category_id'] = $store;
            $this->_getWriteAdapter()->insert($this->getTable('firstslider/slide_category'), $storeArray);
        }
        return parent::_afterSave($object);
    }

/// -----------------------------
//
//	public function load(Mage_Core_Model_Abstract $object, $value, $field=null)
//	{
//		if (!intval($value) && is_string($value)) {
//			$field = 'name';
//		}
//		return parent::load($object, $value, $field);
//	}


    protected function _afterLoad(Mage_Core_Model_Abstract $object) {

        $select = $this->_getReadAdapter()->select()
                        ->from(array('category' => $this->getTable('firstslider/category')))
                        ->joinLeft(array(
                            'slide_category' => $this->getTable('firstslider/slide_category')),
                                'slide_category.category_id = category.category_id',
                                array())
                        ->where('slide_category.slide_id = ?', $object->getId());

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $categoryArray = array();
            foreach ($data as $row) {
                $categoryArray[] = $row['category_id'];
                $categoryNameArray[] = $row['name'];
            }
            $object->setData('category_id', $categoryArray);
            $object->setData('name', implode(",", $categoryNameArray));
        }

        return parent::_afterLoad($object);
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('firstslider/slide_category'), 'slide_id=' . $object->getId());
    }

}