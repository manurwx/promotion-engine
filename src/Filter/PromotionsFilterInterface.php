<?php
declare(strict_types=1);

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

interface PromotionsFilterInterface
{
    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotions): PromotionEnquiryInterface;
}