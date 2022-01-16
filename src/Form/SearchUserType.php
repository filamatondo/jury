<?php

namespace App\Form;

use App\Entity\User;
use App\Search\SearchUser;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('filtrerParPrenom', EntityType::class, [
            //     'label' => 'Filtrer par prenom',
            //     'required' => false,
            //     'placeholder' => '--choisir par prenom --',
            //     'class' => User::class,
            //     'choice_label' => function (User $user) {
            //         return strtoupper($user->getPrenom());
            //     }
            // ])

            ->add('filtrerParNom', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Rechercher par nom']
               
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchUser::class,
            'method' => 'get',
            'csrf_user' => false
        ]);
    }
}
