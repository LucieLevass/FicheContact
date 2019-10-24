<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\ContactType;

class ContactController extends AbstractController
{

    /**
     * @Route("/", name="contact")
     */
    public function create(Request $request, ObjectManager $manager, \Swift_Mailer $mailer){
      $contact = new Contact();

      $form = $this->createForm(ContactType::class, $contact);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($contact);
        $manager->flush();

        $this->sendMail($mailer, $contact->getNom(), $contact->getPrenom(), $contact->getMail(),
                        $form->get('departements')->getData()->getMail(), $contact->getMessage());

        return $this->redirectToRoute('contact');
      }

      return $this->render('contact/index.html.twig', [
          'form' => $form->createView(),
      ]);
    }

    private function sendMail( \Swift_Mailer $mailer, string $nom, string $prenom, string $mailFrom, string $mailTo, string $contenu){
      $message = (new \Swift_Message($prenom." ".$nom))
        ->setFrom($mailFrom)
        ->setTo($mailTo)
        ->setBody($contenu) ;
      $mailer->send($message);
    }

}
