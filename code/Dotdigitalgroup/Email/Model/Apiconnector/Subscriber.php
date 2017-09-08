<?php

class Dotdigitalgroup_Email_Model_Apiconnector_Subscriber extends Dotdigitalgroup_Email_Model_Apiconnector_Customer
{
    /**
     * constructor, mapping hash to map.
     *
     * @param $mappingHash
     */
    public function __construct($mappingHash)
    {
        parent::__construct($mappingHash);
    }

    /**
     * Set key value data.
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->objectData[] = $data;
    }

    /**
     * Set subscriber data with sales.
     *
     * @param Mage_Newsletter_Model_Subscriber $subscriber
     */
    public function setSubscriberData(Mage_Newsletter_Model_Subscriber $subscriber)
    {
        $this->object = $subscriber;
        foreach ($this->getMappingHash() as $key => $field) {
            //Call user function based on the attribute mapped.
            $function = 'get';
            $exploded = explode('_', $key);
            foreach ($exploded as $one) {
                $function .= ucfirst($one);
            }

            try {
                //@codingStandardsIgnoreStart
                $value = call_user_func(array('self', $function));
                //@codingStandardsIgnoreEnd
                $this->objectData[$key] = $value;
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
    }

    /**
     * @return string
     */
    protected function _getWebsiteName()
    {
        $storeId = $this->object->getStoreId();
        $website = Mage::app()->getStore($storeId)->getWebsite();
        if ($website) {
            return $website->getName();
        }

        return '';
    }
}