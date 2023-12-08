<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\CourseRepository;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CourseRepository $coursesRepository, PaginatorInterface $paginator): Response
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

    public function searchBar( Request $request): Response
    {
        $searchData =new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $searchData->q;
        }
  
        return $this->render('partial/_search_data.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
