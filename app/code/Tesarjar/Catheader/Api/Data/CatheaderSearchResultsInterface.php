<?php


namespace Tesarjar\Catheader\Api\Data;

/**
 * Interface CatheaderSearchResultsInterface
 *
 * @package Tesarjar\Catheader\Api\Data
 */
interface CatheaderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Catheader list.
     * @return \Tesarjar\Catheader\Api\Data\CatheaderInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Tesarjar\Catheader\Api\Data\CatheaderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

