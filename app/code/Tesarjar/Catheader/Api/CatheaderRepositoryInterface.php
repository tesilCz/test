<?php


namespace Tesarjar\Catheader\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CatheaderRepositoryInterface
 *
 * @package Tesarjar\Catheader\Api
 */
interface CatheaderRepositoryInterface
{

    /**
     * Save Catheader
     * @param \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
     * @return \Tesarjar\Catheader\Api\Data\CatheaderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
    );

    /**
     * Retrieve Catheader
     * @param string $catheaderId
     * @return \Tesarjar\Catheader\Api\Data\CatheaderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($catheaderId);

    /**
     * Retrieve Catheader matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tesarjar\Catheader\Api\Data\CatheaderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Catheader
     * @param \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tesarjar\Catheader\Api\Data\CatheaderInterface $catheader
    );

    /**
     * Delete Catheader by ID
     * @param string $catheaderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($catheaderId);
}

