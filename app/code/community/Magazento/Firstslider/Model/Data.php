<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
Class Magazento_Firstslider_Model_Data {

    
    protected function getSlideModel() {
        return Mage::getModel('firstslider/slide');
    }

    protected function getItemCollection($cid) {
        $collection = $this->getSlideModel()->getCollection();
        $collection->addFilter('is_active', 1);
        $collection->addCategoryFilter($cid);
        $collection->addNowFilter();
        $collection->addOrder('position', 'ASC');
        return $collection;
    }

    public function getItems($cid) {
        return $this->getItemCollection($cid);
    }

    public function hasItems($cid) {

        return $this->getItemCollection($cid)->count();
    }

}