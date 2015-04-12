<?php

namespace Imagine\Promocode\Model;

use Imagine\Promocode\Model\Validator as Validator;
use Magento\Framework\Event\Observer as EventObserver;

class Observer
{
    protected $ruleFactory;
    protected $quote;
    protected $coupon;

    public function __construct(
        \Magento\SalesRule\Model\RuleFactory $ruleFactory,
        \Magento\Sales\Model\Quote $quote,
        \Magento\SalesRule\Model\Coupon $coupon
    ) {
        $this->ruleFactory = $ruleFactory;
        $this->quote = $quote;
        $this->coupon = $coupon;
    }
    /**
     *
     * @param EventObserver $observer
     */
    public function execute($observer)
    {
        $params = [];
        // Check configuration flag
        // Check if the rule exists and load it
        // Prepare params array
        $quote      = $observer->getEvent()->getQuote();
        $couponCode = $this->coupon->loadByCode($this->quote->getCouponCode());
        $params = ['coupon' => $couponCode, 'rule' => null, 'quote'=> $quote];
        //$rule   = 
        // Call the Validator
        $validator = new Validator();
        $validator->validate($params);
    }
}

