<?php

class Dathent_Categoryreview_Block_Adminhtml_Categoryreview_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);	  
	  $reviewdetail	=	Mage::registry('categoryreview_data')->getData();
	  $custid	=	(isset($reviewdetail['custid']))? $reviewdetail['custid'] : null;
	  //for category name and url
	  $catid	=	$reviewdetail['catid'];
	  $customer = Mage::getModel('customer/customer')->load($custid);  
	  $category = Mage::getModel('catalog/category')->load($catid); 
	  $caturl	= $category->getUrl();
	  $catname	= $category->getName();
	  $cattext	= Mage::helper('categoryreview')->__('<a href="%1$s" target="_blank">%2$s</a>',$caturl,$catname);
	  
      $fieldset = $form->addFieldset('categoryreview_form', array('legend'=>Mage::helper('categoryreview')->__('Review information')));

      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('categoryreview')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('categoryreview')->__('Not Approved'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('categoryreview')->__('Approved'),
              ),
          ),
      ));

       $fieldset->addField('catid', 'note', array(
          'label'     => Mage::helper('categoryreview')->__('Category'),
          'text'      => $cattext,
      ));

      $fieldset->addField('created_at', 'date', array(
          'name'   => 'created_at',
          'class'     => 'required-entry',
          'required'  => true,
          'label'  => Mage::helper('catalogrule')->__('Date'),
          'title'  => Mage::helper('catalogrule')->__('Date'),
          'image'  => $this->getSkinUrl('images/grid-cal.gif'),
          'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
          'format'       => 'yyyy-MM-dd ',
          'value' => 'created_at',
      ));


		if ($customer->getId()) {
            $customerText = Mage::helper('categoryreview')->__('%1$s', $this->htmlEscape($customer->getName()));
            $email = $this->htmlEscape($customer->getEmail());
            $nickname = $this->htmlEscape($customer->getName());
        } else {
            if (is_null($form->getCustid())) {
                $customerText = Mage::helper('categoryreview')->__('Guest');
            } elseif ($form->getCustid() == 0) {
                $customerText = Mage::helper('categoryreview')->__('Administrator');
            }
            $email = Mage::helper('categoryreview')->__('<a href="mailto:%1$s">%1$s</a>', $reviewdetail['email']);
            $nickname = $reviewdetail['nickname'];
        }
	 $fieldset->addField('custid', 'note', array(
            'label'     => Mage::helper('categoryreview')->__('Posted By'),
            'text'      => $customerText,
        ));
      if(isset($email)){
          $fieldset->addField('email', 'note', array(
              'label'     => Mage::helper('categoryreview')->__('E-mail'),
              'text'      => $email,
          ));
      }

      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('categoryreview')->__('First Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'text'      => $nickname,
          'name'      => 'name',
      ));

      $fieldset->addField('city', 'text', array(
          'label'     => Mage::helper('categoryreview')->__('City'),
          'class'     => 'required-entry',
          'required'  => true,
         /* 'text'      => $nickname,*/
          'name'      => 'city',
      ));

      $fieldset->addField('telephone', 'text', array(
          'label'     => Mage::helper('categoryreview')->__('Telephone'),
          'class'     => 'required-entry',
          'required'  => true,
          /*'text'      => $nickname,*/
          'name'      => 'telephone',
      ));


      $fieldset->addField('product_rew', 'editor', array(
          'name'      => 'product_rew',
          'label'     => Mage::helper('categoryreview')->__('Products Review'),
          'title'     => Mage::helper('categoryreview')->__('Products Review'),
          'style'     => 'width:700px; height:200px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));

      $fieldset->addField('visible_main', 'select', array(
          'label'     => Mage::helper('categoryreview')->__('Visible on the main page'),
          'name'      => 'visible_main',
          'values'    => array(
              array(
                  'value'     => 2,
                  'label'     => Mage::helper('categoryreview')->__('Not Visible'),
              ),

              array(
                  'value'     => 1,
                  'label'     => Mage::helper('categoryreview')->__('Visible'),
              ),
          ),
      ));

      $fieldset->addField('shop_rew', 'editor', array(
          'name'      => 'shop_rew',
          'label'     => Mage::helper('categoryreview')->__('Review on store'),
          'title'     => Mage::helper('categoryreview')->__('Review on store'),
          'style'     => 'width:700px; height:200px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getCategoryreviewData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCategoryreviewData());
          Mage::getSingleton('adminhtml/session')->setCategoryreviewData(null);
      } elseif ( Mage::registry('categoryreview_data') ) {
          $form->setValues(Mage::registry('categoryreview_data')->getData());
      }
      return parent::_prepareForm();
  }
}