<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request, 
        EntityManagerInterface $em, 
        MailerInterface $mailer
    ): Response
    {
        $contact = new Contact();
        // pré-remplis si un utilisateur se connecte déjà.
        if($this->getUser()){
          $contact->setFullname($this->getUser()->getFullname())
                  ->setEmail($this->getUser()->getEmail());

        }
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $em->persist($contact);
            $em->flush();
            // envoyer email
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('admin@lol.com')
            ->subject($contact->getSuject())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
            
            ]);
            $mailer->send($email);

            $this->addFlash('success','Merci pour votre message, nous allons vous répondre au meilleur délais.');
            return $this->redirectToRoute('app_contact');
        }
        

        return $this->render('contact/index.html.twig', [
            'form_contact' => $form->createView(),
            
        ]);
    }
}
