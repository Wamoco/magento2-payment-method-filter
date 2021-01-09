<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\PaymentMethodFilter\Model;

class FilterProcessor
{
    /**
     * @var array
     */
    protected $filters = [];

    /**
     * __construct
     *
     * @param array $filters
     */
    public function __construct(
        array $filters = []
    ) {
        $this->filters = $filters;
    }

    /**
     * isFiltered
     *
     * @param \Magento\Quote\Api\Data\PaymentMethodInterface $method
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return bool
     */
    public function isFiltered(
        \Magento\Quote\Api\Data\PaymentMethodInterface $method,
        \Magento\Quote\Api\Data\CartInterface $quote
    ) {
        foreach ($this->filters as $filter) {
            if ($filter instanceof \Wamoco\PaymentMethodFilter\Api\FilterInterface) {
                if ($filter->isFiltered($method, $quote)) {
                    return true;
                }
            }
        }
        return false;
    }
}
