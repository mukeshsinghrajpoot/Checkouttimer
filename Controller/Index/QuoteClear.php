<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\Checkouttimer\Controller\Index;

class QuoteClear extends \Magento\Framework\App\Action\Action
{   protected $_objectManager;
    protected $_pageFactory;
    private $helperData; 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_objectManager = $objectmanager;
        return parent::__construct($context);
    }
    public function execute()
    {
        $cartObject = $this->_objectManager->create('Magento\Checkout\Model\Cart')->truncate(); 
        if($cartObject->save())
        {
            $data = array('message'=>'true');
                echo  json_encode($data);
        }else
        {
            $data = array('message'=>'false');
                echo  json_encode($data);
        }
    }
}