<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductPromotion;
use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setPrice(100);
        $manager->persist($product);

        $promotion1 = new Promotion();
        $promotion1->setName('Black Friday half price sale');
        $promotion1->setType('date_range_multiplier');
        $promotion1->setAdjustment(0.5);
        $promotion1->setCriteria(["from" => "2022-11-25", "to" => "2022-11-28"]);
        $manager->persist($promotion1);

        $promotion2 = new Promotion();
        $promotion2->setName('Voucher OU182');
        $promotion2->setType('fixed_price_voucher');
        $promotion2->setAdjustment(100);
        $promotion2->setCriteria(["code" => "OU812"]);
        $manager->persist($promotion2);

        $promotion3 = new Promotion();
        $promotion3->setName('Buy one get one free');
        $promotion3->setType('even_items_multiplier');
        $promotion3->setAdjustment(0.5);
        $promotion3->setCriteria(["minimum_quantity" => "2"]);
        $manager->persist($promotion3);

        $productPromotion1 = new ProductPromotion();
        $productPromotion1->setValidTo(date_create_immutable('2022-11-28 00:00:00'));
        $productPromotion1->setProduct($product);
        $productPromotion1->setPromotion($promotion1);
        $manager->persist($productPromotion1);

        $productPromotion2 = new ProductPromotion();
        $productPromotion2->setValidTo(null);
        $productPromotion2->setProduct($product);
        $productPromotion2->setPromotion($promotion2);
        $manager->persist($productPromotion2);

        $productPromotion3 = new ProductPromotion();
        $productPromotion3->setValidTo(null);
        $productPromotion3->setProduct($product);
        $productPromotion3->setPromotion($promotion3);
        $manager->persist($productPromotion3);

        $manager->flush();
    }
}
