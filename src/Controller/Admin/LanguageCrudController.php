<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LanguageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Language::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural("Langues")
                    ->setEntityLabelInSingular("Langue")
                    ->setPageTitle("index", "LOLanguages - Admin des langues")
                    ->setPaginatorPageSize(10);
    }
  
}
