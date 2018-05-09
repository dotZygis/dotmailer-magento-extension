<?php

class Dotdigitalgroup_Email_Model_Adminhtml_Email_Template extends Mage_Adminhtml_Model_Email_Template
{
    /**
     * Decompress the text content for admin.
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _afterLoad()
    {
        //decompress the title
        $this->setTemplateSubject(utf8_decode($this->getTemplateSubject()));
        $templateText = $this->getTemplateText();
        $transactionalHelper = Mage::helper('ddg/transactional');
        if ($transactionalHelper->isStringCompressed($templateText)) {
            $this->setTemplateText($transactionalHelper->decompresString($templateText));
        }

        return parent::_afterLoad(); // TODO: Change the autogenerated stub
    }

}