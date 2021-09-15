<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_list")
     */
    public function list(): Response
    {
        // On récupère les produits en BDD
       $repository = $this->getDoctrine()->getRepository(Product::class);

        // Tous les produits
        $products = $repository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function productCreate(Request $request, SluggerInterface $slugger) {

        $product = new Product();

        $createForm = $this->createForm(ProductType::class, $product);

        $createForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et aussi valide
        if ($createForm->isSubmitted() && $createForm->isValid())
        {
            // Si le name est MacBook Pro, le slug est macbook-pro
            $slug = $slugger->slug($product->getName())->lower();
            $product->setSlug($slug);
            $product->setCreatedAt(new \DateTimeImmutable());
        
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
     * @Route("/product/{slug}", name="product_show")
     * 
     * Symfony va interpréter l'argument Product avec le Param Converter, il va
     * chercher le produit dans le slug.
     */
    public function show(Product $product)
    {
        // Première solution sans le paramconverter avec le paramètre $slug
        // $repository = $this->getDoctrine()->getRepository(Product::class);
        // $product = $repository->findOneBy(['slug' => $slug]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

}
