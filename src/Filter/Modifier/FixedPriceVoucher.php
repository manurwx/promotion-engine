<?php
declare(strict_types=1);

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class FixedPriceVoucher implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): float
    {
        if (!($enquiry->getVoucherCode() === $promotion->getCriteria()['code'])) {
            return $price * $quantity;
        }

        return $promotion->getAdjustment() * $quantity;
    }
}