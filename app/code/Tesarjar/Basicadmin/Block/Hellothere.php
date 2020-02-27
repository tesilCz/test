<?php

namespace Tesarjar\Basicadmin\Block;

class Hellothere extends \Magento\Framework\View\Element\Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getHelloText() {
        return __('Hello there!');
    }

    public function getTestText() {
        return __('Test text over there...');
    }

}