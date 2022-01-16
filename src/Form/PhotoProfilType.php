<?php

namespace App\Form;

use App\Entity\PhotoProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class PhotoProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageprofil_upload',FileType::class, [
                'label' => false, 
                'mapped' => false, 
               
            ])

            ->add('celibataire', ChoiceType::class,[
                'label' => false, 
                'choices' => [
                'situation matrimoniale' => 'situation matrimoniale',
                'Célibataire' => 'Célibataire',
                'Mariée' => 'Mariée',
                ' Veuve' => 'Veuve',
                'Divorcée' => 'Divorcée',
                ]
            ])
             
            
            
            ->add('Pays', CountryType::class,
             array()
            )
            
            
             
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PhotoProfil::class,
        ]);
    }
}
