<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        // On crée un formulaire avec Symfony
        $form = $this->createFormBuilder()
                     ->add('name')
                     ->add('email')
                     ->add('message', TextareaType::class)
                     ->add('country', CountryType::class)
                     ->getForm();

        // On va faire le lien entre le formulaire et les données de la requête
        $form->handleRequest($request);

        // On vérifie si le formulaire est soumis et aussi valide
        if ($form->isSubmitted() && $form->isValid())
        {
            // On peut récupérer les données du formulaire
            dump($form->getData());
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
