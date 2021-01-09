# Magento 2 Payment Method Filter

Module to implement custom filter logic for payment methods.

In your module `di.xml` declare the filter:

    <type name="Wamoco\PaymentMethodFilter\Model\FilterProcessor">
        <arguments>
            <argument name="filters" xsi:type="array">
                <item name="checkmo" xsi:type="object">Vendor\Module\Model\Filter</item>
            </argument>
        </arguments>
    </type>

And implement it like this:

    class Filter implements \Wamoco\PaymentMethodFilter\Api\FilterInterface
    {
        public function isFiltered(
            \Magento\Quote\Api\Data\PaymentMethodInterface $method,
            \Magento\Quote\Api\Data\CartInterface $quote
        ) {
            if ($method->getCode() == 'checkmo') {
              return true;
            }
            return false;
        }
    }

