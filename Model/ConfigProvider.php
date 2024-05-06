<?php
namespace Bluethinkinc\Checkouttimer\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Bluethinkinc\Checkouttimer\Helper\Data; 
class ConfigProvider implements ConfigProviderInterface
{
    /** @var LayoutInterface  */
    protected $_layout;
    private $_serializer;
    private $helperData; 
    public function __construct(
        LayoutInterface $layout,
        Json $_serializer,
        Data $helperData
    ) {
        $this->_layout = $layout;
        $this->_serializer = $_serializer;
        $this->helperData = $helperData;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    { 
        $isChecoutTimerEnabled = $this->helperData->isChecoutTimerEnabled();
        $checkouttimelabel = $this->helperData->checkouttimelabel();
        $config = [
            'payment' => [    
                'custom_config' => [/*Add your custom variables here*/
                    'ischecouttimerenabled' => $isChecoutTimerEnabled,
                ]
            ],
            'checkouttimelabel' => [    
                'custom_config' => [/*Add your custom variables here*/
                    'checkouttimelabel' => $checkouttimelabel,
                ]
            ]
        ];
       
        return $config;
    }
}