<?php
declare(strict_types=1);

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
    public function setPrice(float $price): void;

    public function setDiscountedPrice(float $discountedPrice): void;

    public function getQuantity(): ?int;
}