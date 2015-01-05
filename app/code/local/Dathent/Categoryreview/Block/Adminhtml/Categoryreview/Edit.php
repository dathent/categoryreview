<?php

class Dathent_Categoryreview_Block_Adminhtml_Categoryreview_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'categoryreview';
        $this->_controller = 'adminhtml_categoryreview';
        
        $this->_updateButton('save', 'label', Mage::helper('categoryreview')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('categoryreview')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('categoryreview_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'categoryreview_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'categoryreview_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('categoryreview_data') && Mage::registry('categoryreview_data')->getId() ) {
            return Mage::helper('categoryreview')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('categoryreview_data')->getTitle()));
        } else {
            return Mage::helper('categoryreview')->__('Add Item');
        }
    }
}