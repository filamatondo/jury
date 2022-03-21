<?php

namespace App\Form;

use symfony\Component\Form\AbstractType;
use App\FormExtension\RepeatedPasswordType;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType

{
    public function builderForm(FormBuilderInterface $builder, array $options)


    {
        $builder->add('password', RepeatedPasswordType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'data_class' => User::class


        ]);
    }
}
