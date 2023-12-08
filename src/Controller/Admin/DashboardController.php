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
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
    
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CourseCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sf LOLanguages');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cours', 'fas fa-list', Course::class);
        yield MenuItem::linkToCrud('Langues', 'fas fa-list', Language::class);
        yield MenuItem::linkToCrud('Niveau', 'fas fa-list', Level::class);
        yield MenuItem::linkToCrud('Etiquette', 'fas fa-list', Tag::class);
        yield MenuItem::linkToCrud('Enseignant', 'fas fa-list', Teacher::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);

    }
}
