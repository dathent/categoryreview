<?php

class Dathent_Categoryreview_Model_Mysql4_Categoryreview extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the categoryreview_id refers to the key field in your database table.
        $this->_init('categoryreview/categoryreview', 'categoryreview_id');
    }
}