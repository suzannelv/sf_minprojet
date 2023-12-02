<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label'=>'Prénom',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control form-control-lg'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label'=>'Nom',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control form-control-lg'
                ]

            ])
            ->add('pseudo', TextType::class,[
                'label'=>'Pseudo',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control form-control-lg'
                ]

            ])

            ->add('email', TextType::class,[
                'label'=>'Email',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control form-control-lg'
                ]

              ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=>'Accepter tous les termes et les conditions',
                'label_attr'=>[
                    'class'=>'form-check-label text-secondary'
                ],
                'attr'=>[
                    'class'=>'form-check-input ms-3'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes et conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'=> PasswordType::class,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class'=>'form-control form-control-lg'
                
                ],
                'first_options'=>[
                    'label'=>"Confirmation du mot de passe",
                    'label_attr'=>[
                        'class'=>'form-label'
                    ],
                    'attr'=>[
                        'class'=>'form-control form-control-lg'
                    ]
                ],
                'second_options'=>[
                    'label'=>"Mot de passe",
                    'label_attr'=>[
                        'class'=>'form-label'
                    ],
                    'attr'=>[
                        'class'=>'form-control form-control-lg'
                    ]
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez le mot de passe',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit être au minimum {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('profileUser', FileType::class, [
                'label'=>'Télécharger votre photo',
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]

            ])      
            ->add('submit', SubmitType::class, [
                'label'=>'S\'inscrire',
                'attr'=>[
                    'class'=>'btn btn-warning btn-lg ms-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false
        ]);
    }
}
