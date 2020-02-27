<?php


namespace Tesarjar\Catheader\Model;

use Tesarjar\Catheader\Api\Data\CatheaderInterface;
use Tesarjar\Catheader\Api\Data\CatheaderInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Class Catheader
 *
 * @package Tesarjar\Catheader\Model
 */
class Catheader extends \Magento\Framework\Model\AbstractModel
{

    protected $catheaderDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'tesarjar_catheader_catheader';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CatheaderInterfaceFactory $catheaderDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Tesarjar\Catheader\Model\ResourceModel\Catheader $resource
     * @param \Tesarjar\Catheader\Model\ResourceModel\Catheader\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CatheaderInterfaceFactory $catheaderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Tesarjar\Catheader\Model\ResourceModel\Catheader $resource,
        \Tesarjar\Catheader\Model\ResourceModel\Catheader\Collection $resourceCollection,
        array $data = []
    ) {
        $this->catheaderDataFactory = $catheaderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve catheader model with catheader data
     * @return CatheaderInterface
     */
    public function getDataModel()
    {
        $catheaderData = $this->getData();
        
        $catheaderDataObject = $this->catheaderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $catheaderDataObject,
            $catheaderData,
            CatheaderInterface::class
        );
        
        return $catheaderDataObject;
    }
}

