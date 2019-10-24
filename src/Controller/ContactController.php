<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\DepartementEnt;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(DepartementEnt::class);
        $deps = $repo->findAll();

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'departements' => $deps ,
        ]);
    }

    /**
     * @Route("/", name="contact")
     */
    public function create(Request $request, ObjectManager $manager, \Swift_Mailer $mailer){

      $contact = new Contact();

      $form = $this->createFormBuilder($contact)
              -> add('nom')
              -> add('prenom')
              -> add('mail')
              -> add('departements', EntityType::class, [
                'class' => DepartementEnt::class,
                'choice_label' => 'nom',
              ])
              -> add('message')
              -> add('Envoyer', SubmitType::class)
              -> getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($contact);
        $manager->flush();

        $message = (new \Swift_Message($contact->getPrenom()." ".$contact->getNom()))
          ->setFrom($contact->getMail())
          ->setTo($form->get('departements')->getData()->getMail())
          ->setBody($contact->getMessage()) ;
        $mailer->send($message);

        return $this->redirectToRoute('contact');
      }

      return $this->render('contact/index.html.twig', [
          'form' => $form->createView(),
      ]);

    }




}
