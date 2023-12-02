<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Language;
use App\Repository\CourseRepository;
use App\Repository\LanguageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/course')]
class CourseController extends AbstractController
{
    public function __construct(private CourseRepository $courseRepository)
    {

    }
    #[Route('/', name: 'course_page')]
    public function list(Request $request, PaginatorInterface $paginator, LanguageRepository $languageRepository): Response
    {
        $languages= $languageRepository->findAll();
        $courses = $paginator->paginate(
            $this->courseRepository->findAll(),
            $request->query->getInt('page', 1), 
            6
        );

        return $this->render('course/index.html.twig', [
            'courses' => $courses,
            'languages'=>$languages
        ]);
    }
    #[Route('/{id}', name:'course_item')]
    public function item(Course $course): Response
    {
        $level= $course->getLevel();
        $lang=$course->getLang();
        $teacher=$course->getTeacher();
        $profile = $teacher->getProfile();
     
        return $this->render('course/item.html.twig',[
            'course'=>$course,
            'level'=>$level->getName(),
            'lang'=>$lang->getName(),
            'teacher'=> $teacher->getFirstname() . ' ' . $teacher->getLastname(),
            'profile'=>$profile
        ]);
    }
}
