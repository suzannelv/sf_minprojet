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


    #[Route('/search', name: 'search', methods:['GET'])]
    public function searchBar(Request $request, CourseRepository $coursesRepository, PaginatorInterface $paginator): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);

        $queryBuilder = $coursesRepository->getSearchQueryBuilder($searchData);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1), 
            6
        );

        return $this->render('partial/_search_data.html.twig', [
            'form_search' => $form->createView(),
            'search_course' => $pagination,
        ]);
    }

}
