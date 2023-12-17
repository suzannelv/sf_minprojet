<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=> 'Nom/Prénom',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            
            ])
            ->add('email', TextType::class, [
                'label'=>'Email',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            
            ])
            ->add('suject', TextType::class, [
                'label'=>'Sujet',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('message', TextareaType::class,[
                'label'=>'Message',
                'label_attr'=>[
                    'class'=>'form-label',
                    'id'=>'comment'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr'=>[
                    'class'=>'btn',    
                ],
            ]
            );
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => false

        ]);
    }
}
