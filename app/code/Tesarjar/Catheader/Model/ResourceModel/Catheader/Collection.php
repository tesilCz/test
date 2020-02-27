<?php


namespace Tesarjar\Catheader\Model\ResourceModel\Catheader;

/**
 * Class Collection
 *
 * @package Tesarjar\Catheader\Model\ResourceModel\Catheader
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'catheader_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Tesarjar\Catheader\Model\Catheader::class,
            \Tesarjar\Catheader\Model\ResourceModel\Catheader::class
        );
    }
}

