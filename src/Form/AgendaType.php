<?php

namespace App\Form;

use App\Entity\Agenda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AgendaType extends AbstractType
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
                'attr' => ['placeholder' => 'Entrez votre prenom']

            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre email']

            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre telephone']

            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre adresse']

            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre ville']

            ])
            ->add('code', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre code_poste']

            ])
            ->add('text', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre text']

            ])
            ->add('date', BirthdayType::class, [
                'label' => false,


            ])
            

            //   ->add('bloc')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agenda::class,
        ]);
    }
}
