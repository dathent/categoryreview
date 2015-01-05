<?php

class Dathent_Categoryreview_Model_Status extends Varien_Object
{
    const STATUS_APPROVED	= 2;
    const STATUS_NOT_APPROVED	= 1;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_NOT_APPROVED   => Mage::helper('categoryreview')->__('Not Approved'),
            self::STATUS_APPROVED    => Mage::helper('categoryreview')->__('Approved'),
        );
    }
}