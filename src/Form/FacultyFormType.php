<?php

namespace App\Form;

use App\Entity\Faculty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FacultyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('label', TextType::class,
        ['attr' => ['class' => 'form-control filter-list-input']]
        )
        ->add("submit", SubmitType::class,
        ['attr' => ['class' => 'btn btn-warning btn-block']]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Faculty::class,
        ]);
    }
}
