<?php
/**
 * Created by PhpStorm.
 * User: User Home
 * Date: 27.09.14
 * Time: 13:12
 */

class Dathent_Categoryreview_Block_Store extends Dathent_Categoryreview_Block_Categoryreview
{
    public function getReviews()
    {
        $reviews = Mage::getSingleton('categoryreview/categoryreview')->getCollectionStoreReviews();
        shuffle($reviews);
        return $reviews;
    }

}