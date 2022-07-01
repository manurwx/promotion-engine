<?php
declare(strict_types=1);

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use App\Filter\PromotionsFilterInterface;
use App\Repository\ProductRepository;
use App\Repository\PromotionRepository;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly PromotionRepository $promotionRepository
    )
    {
    }

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionsFilterInterface $promotionsFilter
    ): Response
    {
        if ($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Promotions Engine failure message'],
                (int)$request->headers->get('force_fail')
            );
        }

        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(),
            LowestPriceEnquiry::class,
            'json'
        );

        $product = $this->productRepository->find($id); // TODO: add error handling for not found product

        $lowestPriceEnquiry->setProduct($product);

        $promotions = $this->promotionRepository->findValidForProduct(
            $product,
            date_create_immutable($lowestPriceEnquiry->getRequestDate())
        );

        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);

        $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($responseContent, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}