<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;
use \Magento\Framework\Event\Observer;

class PrepareSaveCustomer implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getData('customer');
        $request = $observer->getEvent()->getData('request');
        //echo $customer->getFirstName();
        $post = $request->getPostValue('customer');
        print_r($post["avatar"]) ;
        die();
        $customer->setData('rating',0);
        $observer->setData('movie',$customer);
    }
}