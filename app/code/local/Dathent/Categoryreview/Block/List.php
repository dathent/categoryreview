<?php
/**
 * Created by PhpStorm.
 * User: User Home
 * Date: 26.09.14
 * Time: 23:03
 */
class Dathent_Categoryreview_Block_List extends Dathent_Categoryreview_Block_Categoryreview
{
    public function getReviews()
    {
        $reviews = Mage::getSingleton('categoryreview/categoryreview')->getCollectionEnableItems($this->getCurrentCategoryId());
        return $reviews;
    }

    public function convertDate($date)
    {
        return Mage::app()->getLocale()->date($date)->toString('dd.MM.YYYY');
    }

}