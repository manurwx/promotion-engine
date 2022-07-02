<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\Product;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class LowestPriceEnquiry implements PriceEnquiryInterface
{
    #[Ignore]
    private ?Product $product;

    #[NotBlank]
    #[Positive]
    private ?int $quantity;

    private ?string $requestLocation;

    private ?string $voucherCode;

    #[NotBlank]
    private ?string $requestDate;

    private ?int $promotionId;

    private ?string $promotionName;

    #[Positive]
    private ?float $price;

    private ?float $discountedPrice;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string|null
     */
    public function getRequestLocation(): ?string
    {
        return $this->requestLocation;
    }

    /**
     * @param string|null $requestLocation
     */
    public function setRequestLocation(?string $requestLocation): void
    {
        $this->requestLocation = $requestLocation;
    }

    /**
     * @return string|null
     */
    public function getVoucherCode(): ?string
    {
        return $this->voucherCode;
    }

    /**
     * @param string|null $voucherCode
     */
    public function setVoucherCode(?string $voucherCode): void
    {
        $this->voucherCode = $voucherCode;
    }

    /**
     * @return string|null
     */
    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }

    /**
     * @param string|null $requestDate
     */
    public function setRequestDate(?string $requestDate): void
    {
        $this->requestDate = $requestDate;
    }

    /**
     * @return int|null
     */
    public function getPromotionId(): ?int
    {
        return $this->promotionId;
    }

    /**
     * @param int|null $promotionId
     */
    public function setPromotionId(?int $promotionId): void
    {
        $this->promotionId = $promotionId;
    }

    /**
     * @return string|null
     */
    public function getPromotionName(): ?string
    {
        return $this->promotionName;
    }

    /**
     * @param string|null $promotionName
     */
    public function setPromotionName(?string $promotionName): void
    {
        $this->promotionName = $promotionName;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getDiscountedPrice(): ?float
    {
        return $this->discountedPrice;
    }

    /**
     * @param float|null $discountedPrice
     */
    public function setDiscountedPrice(?float $discountedPrice): void
    {
        $this->discountedPrice = $discountedPrice;
    }
}