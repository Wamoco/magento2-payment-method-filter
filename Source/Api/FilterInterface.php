<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\PaymentMethodFilter\Api;

interface FilterInterface
{
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
    );
}
