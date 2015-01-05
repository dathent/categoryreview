<?php

class Dathent_Categoryreview_Block_Adminhtml_Categoryreview_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('categoryreview_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('categoryreview')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('categoryreview')->__('Item Information'),
          'title'     => Mage::helper('categoryreview')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('categoryreview/adminhtml_categoryreview_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}