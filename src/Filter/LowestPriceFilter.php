<?php
declare(strict_types=1);

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{
    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {
    }

    public function apply(PromotionEnquiryInterface $enquiry,  Promotion ...$promotions): PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()?->getPrice();
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;

        foreach ($promotions as $promotion) {
            // Run the promotions' modification logic against the enquiry

            // 1. check does the promotion apply e.g. is it in date range / is the voucher code valid?
            $priceModifier = $this->priceModifierFactory->create($promotion->getType());

            // 2. apply the price modification to obtain a $modifiedPrice
            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

            if ($modifiedPrice < $lowestPrice) {
                // 1. Save to Enquiry properties
                $enquiry->setDiscountedPrice($modifiedPrice);
                $enquiry->setPromotionId($promotion->getId());
                $enquiry->setPromotionName($promotion->getName());

                // 2. Update $lowestPrice
                $lowestPrice = $modifiedPrice;
            }
        }

        return $enquiry;
    }
}