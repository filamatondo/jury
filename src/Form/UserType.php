<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('email')
            ->add('photoProfil_upload', FileType::class, [
                'label' => false, 
                'mapped' => false 
            ])

        //     ->add('Pays', CountryType::class,
        //     array()
        //    )
            
            // ->add('roles')
            // ->add('password')
            // ->add('nom')
            // ->add('prenom')
            // ->add('date', BirthdayType::class, [
            //     'label' => false,

            // ])
            // ->add('sexe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
