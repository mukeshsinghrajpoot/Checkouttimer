<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\Checkouttimer\Controller\Index;
use Magento\Quote\Model\QuoteFactory;
use Magento\Checkout\Model\Session as CheckoutSession;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $quoteFactory;
    protected $_objectManager;
    protected $_date;
    protected $quoteRepository;
    protected $checkoutSession;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CheckoutSession $checkoutSession,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Magento\Quote\Api\CartRepositoryInterface  $quoteFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->quoteFactory = $quoteFactory;
        $this->_date =  $date;
        $this->_objectManager = $objectmanager;
        $this->quoteRepository = $quoteRepository;
        $this->checkoutSession = $checkoutSession;
        return parent::__construct($context);
    }
    public function execute()
    {   
           $ConfigTimezone= $this->_date->getConfigTimezone();
           $time = $this->_date->date()->format('d M,Y H:i:s');  
            $customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');
            $current_quote = $this->checkoutSession->getQuote();
            //$current_quote = $this->quoteFactory->get($current_quote->getId());
            if($current_quote->getId())
            {
            $quotedata = $this->quoteRepository->get($current_quote->getId());
            $date=$quotedata->getData('reserved_time');
            $data = array('message'=>'true','date' =>$date,'nowtime'=>$ConfigTimezone);
                echo  json_encode($data);
            }else
            {
                $data = array('message'=>'false');
                echo  json_encode($data);
            }            
        exit();
    }
}