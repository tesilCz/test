<?php


namespace Tesarjar\Catheader\Model\Data;

use Tesarjar\Catheader\Api\Data\CatheaderInterface;

/**
 * Class Catheader
 *
 * @package Tesarjar\Catheader\Model\Data
 */
class Catheader extends \Magento\Framework\Api\AbstractExtensibleObject implements CatheaderInterface
{

    public function getCatheaderId() {
        return $this->_get(self::CATHEADER_ID);
    }

    public function setCatheaderId($catheaderId) {
        return $this->setData(self::CATHEADER_ID, $catheaderId);
    }

    public function getName() {
        return $this->_get(self::NAME);
    }

    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    public function getManufacturer() {
        return $this->_get(self::MANUFACTURER);
    }

    public function setManufacturer($manufacturer) {
        return $this->setData(self::MANUFACTURER, $manufacturer);
    }

    public function getActive() {
        return $this->_get(self::ACTIVE);
    }

    public function setActive($isActive) {
        return $this->setData(self::ACTIVE, $isActive);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tesarjar\Catheader\Api\Data\CatheaderExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

