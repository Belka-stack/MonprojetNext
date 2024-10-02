<?php

// Ce fichier contient tout ce qui va permmetre à symfony de créer un formulaire.

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    // A l'intérieur de la classe on a une méthode qui construit le formulaire
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
           // A l'intérieur de la méthode on va le builder($builder)qui est en fait FormBuilderInterface.C'est un mécanisme d'injection de dépendance.Et dans ce builder on vient ajouter plusieurs éléments(->add..).Qui correspond au propriété de notre entité(table) User. 
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Your firstname",
                'attr' => [
                    'placeholder' => "Indicate your firstname"
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "Your lastname",
                'attr' => [
                    'placeholder' => "Indicate your lastname"
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Your email address",
                'attr' => [
                    'placeholder' => 'Indicate your email address'
                ]
            ])
            ->add('password',PasswordType::class, [
                'label' => "Your password",
                'attr' => [
                    'placeholder' => "Choose your password"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Validate",
                'attr' => [
                    'class' => 'btn'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
