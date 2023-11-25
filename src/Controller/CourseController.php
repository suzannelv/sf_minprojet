<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Repository\CoursesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/course')]
class CourseController extends AbstractController
{
    public function __construct(private CoursesRepository $courseRepository)
    {

    }
    #[Route('/', name: 'course_page')]
    public function list(Request $request, PaginatorInterface $paginator): Response
    {
        $courses = $paginator->paginate(
            $this->courseRepository->findAll(),
            $request->query->getInt('page', 1), 
            6
        );

        return $this->render('course/index.html.twig', [
            'courses' => $courses,
        ]);
    }
    #[Route('/{id}', name:'course_item')]
    public function item(Courses $course): Response
    {
        // $course = $this->courseRepository->find(Courses::class, $id);
        // if($course === null) {
        //     throw new NotFoundHttpException('Cours non trouvé');
        // }
        
        return $this->render('course/item.html.twig',[
            'course'=>$course
        ]);
    }
}
