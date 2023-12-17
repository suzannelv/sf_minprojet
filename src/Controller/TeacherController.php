<?php

namespace App\Controller;

use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{

    public function __construct(
        private TeacherRepository $teacherRepository,

        ){  
    }

    #[Route('/teacher', name: 'app_teacher')]
    public function tacherList(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    #[Route('/teacher/{id<\d+>}', name: 'teacher_self')]
    public function teacher(int $id): Response
    {
        $teacher = $this->teacherRepository->find($id);


        if ($teacher === null) {
            throw new NotFoundHttpException('Enseignant non trouvé');
        }

        return $this->render('teacher/teacher.html.twig', [
            'teacher' => $teacher,
            "courses" => $teacher->getCourses()
        ]);
    }
}
