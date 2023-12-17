<?php

namespace App\Controller\Admin;


use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ContactCrudController extends AbstractCrudController
{

  public static function getEntityFqcn(): string
   {
    return Contact::class;
   }

   public function configureCrud(Crud $crud): Crud
   {
      return $crud->setEntityLabelInPlural("Contacts")
                  ->setEntityLabelInSingular("Contact")
                  ->setPageTitle("index", "LOLanguages - Admin des contacts");
   }

   public function configureShowFields(string $pagename): iterable
   {
    return [
      TextField::new("email")
               ->setFormTypeOption('disabled', 'disabled'),
      TextField::new('fullname'),
      TextareaField::new('message'),
      DateTimeField::new('createdAt')
                    ->setFormTypeOption('disabled', 'disabled'),
    ];
   }
}