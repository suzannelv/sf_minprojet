<?php

namespace App\Controller\Admin;

use App\Entity\Level;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class LevelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Level::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural("Niveaux")
                    ->setEntityLabelInSingular("Niveau")
                    ->setPageTitle("index", "LOLanguages - Admin des niveaux")
                    ->setPaginatorPageSize(10);
    }
}
