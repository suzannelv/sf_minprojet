<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Entity\Language;
use App\Entity\Level;
use App\Entity\Tag;
use App\Entity\Teacher;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    // #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
    
        return $this->render('admin/admin.html.twig'); 

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SF - LOLanguages');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cours', 'fa-solid fa-graduation-cap', Course::class);
        yield MenuItem::linkToCrud('Langues', 'fa-solid fa-language', Language::class);
        yield MenuItem::linkToCrud('Niveau', 'fa-solid fa-layer-group', Level::class);
        yield MenuItem::linkToCrud('Etiquette', 'fa-solid fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Enseignant', 'fa-solid fa-person-chalkboard', Teacher::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-user-group', User::class);


    }
}
