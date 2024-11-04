<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Your firtname',
                'attr' => [
                    'placeholder' => 'Put your firstname'
                ]
            ] )
            ->add('lastname', TextType::class,[
                'label' => 'Your lastname',
                'attr' => [
                    'placeholder' => 'Put your lastname'
                ]
            ] )
            ->add('address', TextType::class, [
                'label' => 'Your address',
                'attr' => [
                    'placeholder' => 'Put your address'
                ]
            ])
            ->add('postal',TextType::class, [
                'label' => 'Your postal code',
                'attr' => [
                    'placeholder' => 'Put your postal code'
                ]
            ] )
            ->add('city', TextType::class, [
                'label' => 'Your city',
                'attr' => [
                    'placeholder' => 'Put your city'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Your country',
                'attr' => [
                    'placeholder' => 'Put your country'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Your phone number',
                'attr' => [
                    'placeholder' => 'Put your phone number'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "To safeguard",
                'attr' => [
                    'class' => 'btn'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
