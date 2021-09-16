<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repository): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Product::class);

        return $this->render('home/index.html.twig', [
            'randomProduct' => $repository->findAll(),
            'randomLikedProduct' => $repository->findOneByLiked(true),
            'lastProducts' => $repository->findBy([], ['createdAt' => "DESC"], 4),
            'bestProducts' => $repository->findByCheapPriceAtLeast(200, 4),
        ]);
    }
}