<?php

namespace Tesarjar\Cnbcurrency\Model\Currency\Import;

use Magento\Tests\NamingConvention\true\resource;

class Cnb extends \Magento\Directory\Model\Currency\Import\AbstractImport {

    const URL = "https://www.cnb.cz/en/financial-markets/foreign-exchange-market/central-bank-exchange-rate-fixing/central-bank-exchange-rate-fixing/daily.txt";
    protected $jsonHelper;
    protected $httpClientFactory;
    private $scopeConfig;

    /**
     * @param \Magento\Directory\Model\CurrencyFactory $currencyFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        parent::__construct($currencyFactory);
        $this->scopeConfig = $scopeConfig;
        $this->httpClientFactory = $httpClientFactory;
        $this->jsonHelper = $jsonHelper;
    }

    protected function _convert($currencyFrom, $currencyTo, $retry = 0){
        $result = null;
        if($currencyFrom !== 'CZK') {
            $this->_messages[] = __('Base currency must be CZK!');
            return null;
        }
        $url = self::URL;
        $timeout = (int)$this->scopeConfig->getValue(
            'currency/freeCurrencyConverter/timeout',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        /** @var \Magento\Framework\HTTP\ZendClient $httpClient */
        $httpClient = $this->httpClientFactory->create();

        try {
            $response = $httpClient->setUri($url)
                ->setConfig(['timeout' => $timeout])
                ->request('GET')
                ->getBody();

            $lines = explode("\n", $response);
            foreach ($lines as $line) {
                $cols = explode("|", $line);
                if(count($cols) < 4) continue;
                $curCode = $cols[3];

                if($curCode === $currencyTo) {
                    return $cols[2]/$cols[4];
                }
            }

        } catch (\Exception $e) {
            if ($retry == 0) {
                $this->_convert($currencyFrom, $currencyTo, 1);
            } else {
                $this->_messages[] = __('We can\'t retrieve a rate from %1.', $url);
            }
        }
        return $result;
    }

}