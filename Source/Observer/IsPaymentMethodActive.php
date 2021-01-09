<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\PaymentMethodFilter\Observer;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Event\ObserverInterface;

class IsPaymentMethodActive implements ObserverInterface
{
    /**
     * @var \Magento\Quote\Model\Quote
     */
    protected $quote;

    /**
     * @var \Wamoco\PaymentMethodFilter\Model\FilterProcessor
     */
    protected $filterProcessor;

    /**
     * __construct
     *
     * @param CheckoutSession $session
     * @param \Wamoco\PaymentMethodFilter\Model\FilterProcessor $filterProcessor
     * @param \Magento\Quote\Model\Quote $quote
     */
    public function __construct(
        CheckoutSession $session,
        \Wamoco\PaymentMethodFilter\Model\FilterProcessor $filterProcessor,
        \Magento\Quote\Model\Quote $quote = null
    ) {
        $this->filterProcessor = $filterProcessor;
        $this->quote = $quote;
        if (!$quote) {
            $this->quote = $session->getQuote();
        }
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $result = $observer->getResult();
        $methodInstance = $observer->getMethodInstance();
        $quote = $observer->getQuote();

        if (!$quote) {
            $quote = $this->quote;
        }

        if (!$quote) {
            return;
        }

        if ($this->filterProcessor->isFiltered($methodInstance, $quote)) {
            $result->setData('is_available', false);
        }
    }
}
