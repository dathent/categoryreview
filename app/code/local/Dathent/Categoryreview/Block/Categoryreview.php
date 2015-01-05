<?php
class Dathent_Categoryreview_Block_Categoryreview extends Mage_Core_Block_Template
{


    protected  $_error;

    protected $_formData;

    public function getCategoryreview()
     {
        if (!$this->hasData('categoryreview')) {
            $this->setData('categoryreview', Mage::registry('categoryreview'));
        }
        return $this->getData('categoryreview');

    }

    public function getRecaptcha()
    {
        require_once('recaptchalib.php');

        $publickey = "6LdgF_wSAAAAADdmW4fy5wdnq45PaBsyAiiNkZ4P";
        $resp = null;
        $error = $this->getError();

       return recaptcha_get_html($publickey, $error);
    }

    public function getError()
    {
        if(!$this->_error){
            $this->_error = $this->getSession()->getData('recaptcha_error');
            $this->getSession()->setData('recaptcha_error',null);
        }
        return $this->_error;
    }

    public function getBlockError()
    {
        $html = '';
        if($this->getError()){
            $html .= "<div id='error_captcha'></div>";
            $html .= "<script type='text/javascript'>var CaptchaError = 1; jQuery('#error_captcha').append(jQuery('.messages'));</script>";
        }
        return $html;
    }

    public function getFormData()
    {
        if(!$this->_formData){
            $form_data = array();
            if($form_data = $this->getSession()->getData('form_data')){
                $this->getSession()->unsetData('form_data');

            }elseif($this->getCustomer()->getId()){
                $customer = $this->getCustomer();
                $form_data['name'] = $customer->getFirstname();
                $form_data['email'] = $customer->getEmail();
                if($address = $this->getAddress()){
                    $form_data['city'] = $address->getCity();
                    $form_data['telephone'] = $address->getTelephone();
                }
            }
            $dataObj = new Varien_Object();
            $dataObj->addData($form_data);
            $this->_formData = $dataObj;
        }
        return $this->_formData;
    }


    public function getCustomer()
    {
       return $this->getSession()->getCustomer();
    }

    public function getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function getAddress()
    {
        return $this->getCustomer()->getPrimaryShippingAddress();
    }

    public function getCurrentCategoryId()
    {
       return Mage::getSingleton('catalog/layer')->getCurrentCategory()->getId();
    }

}