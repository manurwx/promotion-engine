<?php
declare(strict_types=1);

namespace App\Event;

use App\DTO\PromotionEnquiryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterDtoCreatedEvent extends Event
{
    public const NAME = 'dto.created'; // convention (what_is_it.what_is_doing)

    public function __construct(protected PromotionEnquiryInterface $dto)
    {
    }

    public function getDto(): PromotionEnquiryInterface
    {
        return $this->dto;
    }
}