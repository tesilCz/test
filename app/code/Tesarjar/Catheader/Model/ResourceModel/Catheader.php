<?php


namespace Tesarjar\Catheader\Model\ResourceModel;

/**
 * Class Catheader
 *
 * @package Tesarjar\Catheader\Model\ResourceModel
 */
class Catheader extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tesarjar_catheader_catheader', 'catheader_id');
    }
}

