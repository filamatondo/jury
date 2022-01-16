<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre nom']

            ])

            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre prénom']
            ])

            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre email']

            ])


            ->add('date', BirthdayType::class, [
                'label' => false,


            ])

            ->add('sexe', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Sexe' => '',
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Veuillez accepter les CGUV',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGUV',
                    ])
                ]
            ])


            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,

                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'first_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Entrez votre mot de passe'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez entrer un mot de passe',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Confirmation du mot de passe'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez entrer une confirmation du mot de passe',
                        ]),
                    ],
                ],
            ]); 

             
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
