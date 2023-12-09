<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailNotification
{
  public function __construct(
    private MailerInterface $mailer,
    private string $adminEmail,
  
  ){
 
  }

  public function confirmInscription(string $email, string $lastname, string $firstname):Void
  {
    $email = (new TemplatedEmail())
        ->from($this->adminEmail)
        ->to($email) 
        ->subject('Confirmation d\'inscription')
        ->htmlTemplate('registration/confirmation_email.html.twig')
        ->context([
          'expiration_date' => new \DateTime('+7 days'),
          'user'=> $lastname . ' ' . $firstname
        ]);
     $this->mailer->send($email); 
  }
}