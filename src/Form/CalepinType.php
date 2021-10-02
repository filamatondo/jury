<?php

namespace App\Form;

use App\Entity\Calepin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CalepinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
        ->add('date', DateType::class, [
            'label' => 'Date', 
        ])
            ->add('Nom', TextType::class)
            ->add('Prenom', TextType::class)
            ->add('contenu')
            ->add('telephone')
            ->add('Email')
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calepin::class,
        ]);
    }
}
