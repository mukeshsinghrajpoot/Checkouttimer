<?php
namespace Bluethinkinc\Checkouttimer\Helper;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const CHECKOUT_TIME =  'bluethinkinc_checkout_time/general/checkout_time';
    const CHECKOUT_ENABLE_DISABLE="bluethinkinc_checkout_time/general/enable";
    const CHECKOUT_TIME_LABEL =  'bluethinkinc_checkout_time/general/checkout_time_label';
    private $storeManager;
    protected $scopeConfig;
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }
    public function checkouttime()
    {
        return $this->scopeConfig->getValue(
            self::CHECKOUT_TIME,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    public  function isChecoutTimerEnabled()
    {
         return $this->scopeConfig->getValue(
            self::CHECKOUT_ENABLE_DISABLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );  
    }
    public  function checkouttimelabel()
    {
         return $this->scopeConfig->getValue(
            self::CHECKOUT_TIME_LABEL,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );  
    }
}