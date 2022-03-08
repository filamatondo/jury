<?php

namespace App\Form;

use App\Entity\Apropo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ApropoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('videos',  TextareaType::class)

            ->add('paragraphe_upload', FileType::class, [
                'label' => false,
                'mapped' => false
            ])

            ->add('text',  TextareaType::class)
            ->add('biographie',  TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apropo::class,
        ]);
    }
}
