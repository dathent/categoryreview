<?php
class Dathent_Categoryreview_Block_Adminhtml_Categoryreview extends Mage_Adminhtml_Block_Widget_Container
{

    protected $_addButtonLabel = 'Add New';
    protected $_backButtonLabel = 'Back';
    protected $_blockGroup = 'adminhtml';

  public function __construct()
  {
    $this->_controller = 'adminhtml_categoryreview';
    $this->_blockGroup = 'categoryreview';
    $this->_headerText = Mage::helper('categoryreview')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('categoryreview')->__('Add Item');

     parent::__construct();

      $this->setTemplate('categoryreview/widget/grid/container.phtml');

      $this->_addButton('add', array(
          'label'     => $this->getAddButtonLabel(),
          'onclick'   => 'setLocation(\'' . $this->getCreateUrl() .'\')',
          'class'     => 'add',
      ));
  }

    protected function _prepareLayout()
    {
        $this->setChild( 'grid',
            $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
                $this->_controller . '.grid')->setSaveParametersInSession(true) );
        return parent::_prepareLayout();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

    protected function getAddButtonLabel()
    {
        return $this->_addButtonLabel;
    }

    protected function getBackButtonLabel()
    {
        return $this->_backButtonLabel;
    }

    protected function _addBackButton()
    {
        $this->_addButton('back', array(
            'label'     => $this->getBackButtonLabel(),
            'onclick'   => 'setLocation(\'' . $this->getBackUrl() .'\')',
            'class'     => 'back',
        ));
    }

    public function getHeaderCssClass()
    {
        return 'icon-head ' . parent::getHeaderCssClass();
    }

    public function getHeaderWidth()
    {
        return 'width:50%;';
    }
}