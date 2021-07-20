<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;
use \Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use \Magento\Framework\App\RequestInterface;

class CustomerRegisterSuccessObserver implements ObserverInterface
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
        $customer = $observer->getEvent()->getData('customer');
        $customer->setFirstName("Magenest");
        $this->customerRepository->save($customer);
        //$this->logger->debug($customer->getFirstName());
        //$this->logger->debug($customer->getId());
    }
}