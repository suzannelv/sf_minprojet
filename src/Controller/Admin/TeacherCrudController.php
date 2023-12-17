<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class TeacherCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teacher::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural("Enseignants")
                    ->setEntityLabelInSingular("Enseignant/e")
                    ->setPageTitle("index", "LOLanguages - Admin des enseignants")
                    ->setPaginatorPageSize(10);
    }

  
}
