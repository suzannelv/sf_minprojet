<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural("Etiquettes")
                    ->setEntityLabelInSingular("Etiquette")
                    ->setPageTitle("index", "LOLanguages - Admin des étiquettes")
                    ->setPaginatorPageSize(10);
    }

 
}
