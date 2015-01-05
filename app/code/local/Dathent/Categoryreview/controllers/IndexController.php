<?php
class Dathent_Categoryreview_IndexController extends Mage_Core_Controller_Front_Action
{

    private function validateCaptcha()
    {
        require_once('recaptchalib.php');
        $privatekey = "6LdgF_wSAAAAABhwy0hWjUZQIHR5lVbEETfgcXM3";
        $resp = null;
        $error = null;

        if ($_POST["recaptcha_response_field"]) {
            $resp = recaptcha_check_answer($privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]);

            if ($resp->is_valid) {
                return true;
            } else {
                Mage::getSingleton('customer/session')->setData('recaptcha_error',$resp->error);
                Mage::getSingleton('catalog/session')->addError($this->__('Incorrectly entered CAPTCHA'));
                return false;
            }
        }
    }

	public function catpostAction()
    {


        $data = $this->getRequest()->getPost();

        if($data){
            if($this->validateCaptcha()){
                /* @var $session Mage_Core_Model_Session */
                $session    = Mage::getSingleton('catalog/session');
                /* @var $review Mage_Review_Model_Review */
                $review     = Mage::getModel('categoryreview/categoryreview')->setData($data);

                try {
                    $date = Mage::app()->getLocale()->storeDate(Mage::app()->getStore(), null, true);
                    $review ->setCreatedAt($date->toString('YYYY-MM-dd HH:mm:ss'));
                    $review ->save();
                    $session->addSuccess($this->__('Your review has been accepted for moderation.'));
                }
                catch (Exception $e) {
                    $session->setFormData($data);
                    $session->addError($this->__('Unable to post a review.'));
                }


                if ($redirectUrl = Mage::getSingleton('review/session')->getRedirectUrl(true)) {
                    $this->_redirectUrl($redirectUrl);
                    return;
                }
            }else{
                Mage::getSingleton('customer/session')->setData('form_data', $data);
            }
        }
        $this->_redirectUrl($this->getRequest()->getServer('HTTP_REFERER'));

    }

}