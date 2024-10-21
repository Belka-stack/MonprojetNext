<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('actualPassword', PasswordType::class, [
            'label' => "Your current password",
            'attr' => [
                'placeholder' => "Enter current password",
            ],
            'mapped' => false
        ])

        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'constraints' => [
                new Length([
                    'min' => 4,
                    'max' => 30
                ])
            ],
            'first_options'  => [
                'label' => 'Your new password', 
                'attr' => [
                'placeholder' => "Enter your new password",
                ],
                'hash_property_path' => 'password'
        ],
            'second_options' => [
                'label' => 'Confirm Your new password',
                'attr' => [
                'placeholder' => "Enter your new password",
                ]
                ],
                'mapped' => false,
        ])

        ->add('submit', SubmitType::class, [
            'label' => "Update my password",
            'attr' => [
                'class' => 'btnChangePassword'
            ]

        ])

        ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event){  
            // die('ok mon even marche');
        })
    

    
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
