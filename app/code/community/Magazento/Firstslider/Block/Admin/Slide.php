<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Firstslider_Block_Admin_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'admin_slide';
        $this->_blockGroup = 'firstslider';
        $this->_headerText = Mage::helper('firstslider')->__('Item');
        $this->_addButtonLabel = Mage::helper('firstslider')->__('Add New Item');
        parent::__construct();
    }

}
