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
use Symfony\Component\Form\FormError;
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

            // Récupération du formulaire plus data user

            $form =$event->getForm(); // On va chercher notre formulaire
            $user = $form->getConfig()->getOptions()['data']; // On va chercher notre user actuel
            $passwordHasher = $form->getConfig()->getOptions()['passwordHasher']; // On est venu chercher ce qui nous permet de vérifier l'encodage d'un mot de passe
            
            //1.Récupérer le mot de passe saisi par l’utilisateur et le comparer au mdp en BDD.Il sera à true s'il est valid et false si ce n'est pas le cas.

            $isValid = $passwordHasher->isPasswordValid(
                $user,
                $form->get('actualPassword')->getData()
            );
            
    
        

        // 3. Si c’est != envoyer une erreur

        if (!$isValid) {
            // On va chercher notre formulaire,puis le champs qui est concerné par l'erreur,en l'occurence actual password et on lui la méthode addError() qui permet d'ajouter des erreurs à la volée à des input de notre formulaire.Et elle accepte en paramètre un nouvelle objet FormError qui délivre un message d'erreur si le mot de passe n'est pasconforme.

            $form->get('actualPassword')->addError(new FormError("Your current password is not compliant. Please enter your old password."));
        }
            
        })
    

    
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Par défault notre passwordHasher est null si le formaulaire n'a pas été envoyé dans les options 
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher' => null
        ]);
    }
}
