<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Firstslider_Model_Mysql4_Slide_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    protected function _construct() {
        $this->_init('firstslider/slide');
    }

    public function toOptionArray() {
        return $this->_toOptionArray('slide_id', 'name');
    }

    public function addCategoryFilter($category, $withAdmin = true) {
        if ($category instanceof Mage_Core_Model_Store) {
            $category = array($category->getId());
        }
        $this->getSelect()->join(
                        array('slide_category' => $this->getTable('firstslider/slide_category')),
                        'main_table.slide_id = slide_category.slide_id',
                        array()
                )
                ->where('slide_category.category_id in (?)', $category);
        return $this;
    }

    public function addNowFilter() {
        $now = Mage::getSingleton('core/date')->gmtDate();
        $where = "from_time < '" . $now . "' AND ((to_time > '" . $now . "') OR (to_time IS NULL))";
        $this->getSelect()->where($where);
    }

}