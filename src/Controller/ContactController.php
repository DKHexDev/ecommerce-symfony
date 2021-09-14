<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
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
        // On prépare une entité
        $contact = new Contact();

        // On crée un formulaire avec Symfony
        $form = $this->createForm(ContactType::class, $contact);

        // On va faire le lien entre le formulaire et les données de la requête
        $form->handleRequest($request);

        // On vérifie si le formulaire est soumis et aussi valide
        if ($form->isSubmitted() && $form->isValid())
        {
            // On peut récupérer les données du formulaire
            // dump($form->getData());
            // dump($contact);
            $contact->setAskedAt(new \DateTimeImmutable());

            // Insérer en BDD... Persister un objet avec Doctrine
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact); // Mets de côté l'objet
            $manager->flush(); // INSERT

            // On va rediriger vers la page de contact
            $this->addFlash('success', 'Votre message a été envoyé.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
