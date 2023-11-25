<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LangueController extends AbstractController
{
    #[Route('/langue', name: 'app_langue')]
    public function index(): Response
    {
        return $this->render('langue/index.html.twig', [
            'controller_name' => 'LangueController',
        ]);
    }
}
