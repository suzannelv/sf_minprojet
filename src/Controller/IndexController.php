<?php

namespace App\Controller;

use App\Repository\CoursesRepository;
use Knp\Component\Pager\PaginatorInterface; 
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CoursesRepository $coursesRepository, PaginatorInterface $paginator): Response
    {
        $courses = $coursesRepository->findAll();
         $pagination = $paginator->paginate(
            $courses,
            1, 
            6 
        );

        return $this->render('index/index.html.twig', [
            'courses' =>  $pagination,
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
       
        return $this->render('index/about.html.twig');
    }
}
