<?php


namespace Tesarjar\Catheader\Api\Data;

/**
 * Interface CatheaderInterface
 *
 * @package Tesarjar\Catheader\Api\Data
 */
interface CatheaderInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CATHEADER_ID = 'catheader_id';
    const NAME = 'name';
    const MANUFACTURER = 'manufacturer';
    const ACTIVE = 'active';

    /**
     * Get catheader_id
     * @return string|null
     */
    public function getCatheaderId();

    /**
     * Set catheader_id
     * @param string $catheaderId
     * @return \Tesarjar\Catheader\Api\Data\CatheaderInterface
     */
    public function setCatheaderId($catheaderId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Tesarjar\Catheader\Api\Data\CatheaderInterface
     */
    public function setName($name);


    public function getManufacturer();
    public function setManufacturer($manufacturer);

    public function getActive();
    public function setActive($isActive);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface $extensionAttributes
    );
}

