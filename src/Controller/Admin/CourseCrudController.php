<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInPlural("Cours")
                    ->setEntityLabelInSingular("Cours")
                    ->setPageTitle("index", "LOLanguages - Admin des cours")
                    ->setPaginatorPageSize(10);
    }
 
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('coverImage', 'Cover Image')
                ->setBasePath('uploads/images/')
                ->setLabel('Image URL')
                ->setUploadDir('public/uploads/images') 
                ->setRequired(false), 
            BooleanField::new('isFree'),
            DateTimeField::new('createdAt'),
            AssociationField::new('lang')->autocomplete(),
            AssociationField::new('teacher')->autocomplete(),
            AssociationField::new('level')->autocomplete(),
            AssociationField::new('tags')->autocomplete()->setLabel('Tags'),
        
        ];
    }

}
