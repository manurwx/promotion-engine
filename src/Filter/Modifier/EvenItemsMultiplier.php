<?php
declare(strict_types=1);

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): float
    {
        if ($quantity < 2) {
            return $price * $quantity;
        }

        // Get the odd item... if there is one
        $oddCount = $quantity % 2; // 0 or 1

        $evenCount = $quantity - $oddCount; // deduct either 0 or 1

        return (($evenCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
    }
}