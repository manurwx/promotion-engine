<?php
declare(strict_types=1);

namespace App\Cache;

use App\Entity\Product;
use App\Repository\PromotionRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PromotionCache
{
    public function __construct(private readonly CacheInterface $cache,
                                private readonly PromotionRepository $repository)
    {
    }

    public function findValidForProduct(Product $product, string $requestDate): ?array
    {
        $key = sprintf("find-valid-product-%d", $product->getId());

        return $this->cache->get($key, function (ItemInterface $item) use ($product, $requestDate) {

            $item->expiresAfter(3600); // expire after 1h
            //var_dump('miss');

            return $this->repository->findValidForProduct(
                $product,
                date_create_immutable($requestDate)
            ); // handling if promotions not found (cash miss)
        });
    }
}