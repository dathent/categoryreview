<?php

class Dathent_Categoryreview_Model_Categoryreview extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('categoryreview/categoryreview');
    }

    public function getCollectionEnableItems($categoryId = null)
    {
        $collection = $this->getCollection()->addFilter('status', 2);
        if($categoryId){
            $collection->addFilter('catid',$categoryId);
        }
        $items = $collection->getItems();
        return $items;
    }

    public function getCollectionStoreReviews()
    {
        $collection = $this->getCollection()
            ->addFilter('status', 2)
            ->addFilter('visible_main',1);
        return $collection->getItems();
    }

}