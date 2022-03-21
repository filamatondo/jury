<?php

namespace App\Form;
<<<<<<< HEAD
=======

>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
use App\Entity\User;
use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
<<<<<<< HEAD


=======
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
           
            ->add('message', CKEditorType::class, [
                'attr' =>[
=======

            ->add('message', CKEditorType::class, [
                'attr' => [
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
                    "class" => "form-control"
                ]
            ])

            ->add('envoyer', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
