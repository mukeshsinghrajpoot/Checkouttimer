<?php
namespace Bluethinkinc\Checkouttimer\Observer;

use Magento\Framework\Event\ObserverInterface;
use Bluethinkinc\Checkouttimer\Helper\Data; 
class SaveToQuote implements ObserverInterface {

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * saves rental fields to quote items
     */
     protected $_date;
     protected $_objectManager;
     private $storeManager;
     private $helperData; 
     protected $quoteRepository;
     public function __construct(\Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        Data $helperData,
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    )
    {
      $this->_date =  $date;
      $this->storeManager = $storeManager;
      $this->_objectManager = $objectmanager;
      $this->helperData = $helperData;
      $this->quoteRepository = $quoteRepository;
    }
    public function execute(\Magento\Framework\Event\Observer $observer) {
         $checkouttime = $this->helperData->checkouttime();
         $isChecoutTimerEnabled = $this->helperData->isChecoutTimerEnabled();
         if($isChecoutTimerEnabled=='1')
         {  
         $storeId = $this->storeManager->getStore()->getId();
         $time = $this->_date->date()->format('d M,Y H:i:s');
         $newtime= $this->_date->date(strtotime("+".$checkouttime." minutes"))->format('d M,Y H:i:s') ;
         $cart = $this->_objectManager->get('\Magento\Checkout\Model\Cart');
         $quote = $cart->getQuote();
        // This will return the current quote
        $quoteId = $quote->getId();
        $quotedata = $this->quoteRepository->get($quoteId); // Get quote by id
        $quotedata->setData('reserved_time', $newtime);
        $this->quoteRepository->save($quotedata); // Save quote
       }
    }
}