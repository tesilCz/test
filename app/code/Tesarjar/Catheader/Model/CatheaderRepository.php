<?php


namespace Tesarjar\Catheader\Model;

use Tesarjar\Catheader\Api\CatheaderRepositoryInterface;
use Tesarjar\Catheader\Api\Data\CatheaderSearchResultsInterfaceFactory;
use Tesarjar\Catheader\Api\Data\CatheaderInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Tesarjar\Catheader\Model\ResourceModel\Catheader as ResourceCatheader;
use Tesarjar\Catheader\Model\ResourceModel\Catheader\CollectionFactory as CatheaderCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

/**
 * Class CatheaderRepository
 *
 * @package Tesarjar\Catheader\Model
 */
class CatheaderRepository implements CatheaderRepositoryInterface
{

    protected $resource;

    protected $catheaderFactory;

    protected $catheaderCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataCatheaderFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceCatheader $resource
     * @param CatheaderFactory $catheaderFactory
     * @param CatheaderInterfaceFactory $dataCatheaderFactory
     * @param CatheaderCollectionFactory $catheaderCollectionFactory
     * @param CatheaderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCatheader $resource,
        CatheaderFactory $catheaderFactory,
        CatheaderInterfaceFactory $dataCatheaderFactory,
        CatheaderCollectionFactory $catheaderCollectionFactory,
        CatheaderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->catheaderFactory = $catheaderFactory;
        $this->catheaderCollectionFactory = $catheaderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCatheaderFactory = $dataCatheaderFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
    ) {
        /* if (empty($catheader->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $catheader->setStoreId($storeId);
        } */
        
        $catheaderData = $this->extensibleDataObjectConverter->toNestedArray(
            $catheader,
            [],
            \Tesarjar\Catheader\Api\Data\CatheaderInterface::class
        );
        
        $catheaderModel = $this->catheaderFactory->create()->setData($catheaderData);
        
        try {
            $this->resource->save($catheaderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the catheader: %1',
                $exception->getMessage()
            ));
        }
        return $catheaderModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($catheaderId)
    {
        $catheader = $this->catheaderFactory->create();
        $this->resource->load($catheader, $catheaderId);
        if (!$catheader->getId()) {
            throw new NoSuchEntityException(__('Catheader with id "%1" does not exist.', $catheaderId));
        }
        return $catheader->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->catheaderCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Tesarjar\Catheader\Api\Data\CatheaderInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
    ) {
        try {
            $catheaderModel = $this->catheaderFactory->create();
            $this->resource->load($catheaderModel, $catheader->getCatheaderId());
            $this->resource->delete($catheaderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Catheader: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($catheaderId)
    {
        return $this->delete($this->get($catheaderId));
    }
}

