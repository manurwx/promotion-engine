<?php
declare(strict_types=1);

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;

interface PromotionsFilterInterface
{
    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface;
}