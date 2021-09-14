<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/create", name="product_create")
     */
    public function productCreate(Request $request) {

        $product = new Product();

        $createForm = $this->createForm(ProductType::class, $product);

        $createForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et aussi valide
        if ($createForm->isSubmitted() && $createForm->isValid())
        {
            $product->setCreatedAt(new \DateTimeImmutable());
            $slug = strtolower(str_replace(' ', '-', $product->getName()));
            $product->setSlug($slug);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();

            // On va rediriger vers la page de contact
            $this->addFlash('success', 'Votre produit a été envoyé.');

            return $this->redirectToRoute('product');
        }

        return $this->render('product/create.html.twig', [
            'form' => $createForm->createView(),
        ]);
    }

    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
