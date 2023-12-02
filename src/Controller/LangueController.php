<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/langue')]
class LangueController extends AbstractController
{
    public function __construct(private LanguageRepository $languagesRepository){}
    #[Route('/', name: 'langue')]
    public function languages(): Response
    {

        $languages = $this->languagesRepository->findAll();
        return $this->render('langue/index.html.twig', [
            'languages' =>$languages,
        ]);
    }

    #[Route('/{id}', name:'lang_course')]
    public function showCourses(int $id): Response
    {
        $lang = $this->languagesRepository->find($id);
        if($lang === null){
            throw new NotFoundHttpException('Langue non trouvée');
        }

        $coursCollection = $lang->getCourses();
        // return $this->render('langue/index.html.twig', [
        //     'coursesCollection' => $coursCollection,
        //     'langue'=> $lang

        // ]);
        return $this->render('course/langue/coursesByLang.html.twig', [
            'coursesCollection'=> $coursCollection,
            'langue'=> $lang
        ]);
    }
}
