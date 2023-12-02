<?php

namespace App\Service;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailNotification
{
  public function __construct(
    private MailerInterface $mailer,
    private string $adminEmail,
  ){
 
  }

  public function confirmInscription(User $user):Void
  {
    $email = (new TemplatedEmail())
            ->from($this->adminEmail)
            ->to($user->getEmail()) 
            ->subject('Confirmation d\'inscription')
            ->htmlTemplate('registration/confirmation_email.html.twig')
            ->context([
              'expiration_date' => new \DateTime('+7 days'),
              'user'=> $user
            ]);
     $this->mailer->send($email); 
  }
}