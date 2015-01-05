<?php

class Dathent_Categoryreview_Model_Mysql4_Categoryreview_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('categoryreview/categoryreview');
    }
	
}