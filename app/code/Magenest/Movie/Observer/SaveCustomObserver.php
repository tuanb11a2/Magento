<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;
use \Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use \Magento\Framework\App\RequestInterface;

class SaveCustomObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    private $customerRepository;

    public function __construct(
        LoggerInterface $logger,
        CustomerRepositoryInterface $customerRepository,
        RequestInterface $request
    ){
        $this->logger = $logger;
        $this->customerRepository = $customerRepository;
        $this->_request = $request;
    }
    
    public function execute(Observer $observer)
    {
        $post = $this->_request->getParam('customer');
        echo $post["avatar"]["0"]["url"];
        
        $event = $observer->getEvent();
        $customer = $observer->getCustomerDataObject();
        $customerId = $customer->getId();
        
        $customerData = $this->customerRepository->getById($customerId);
        $customer->setData('avatar',$post["avatar"]["0"]["url"]);
        //$this->customerRepository->save($customer);
    }
}