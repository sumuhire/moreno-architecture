<?php

namespace App\Form;

use App\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PublicationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo',
                TextType::class, 
                [
                "label" => 'Logo',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('label',
                TextType::class, 
                [
                "label" => 'Nom de la publication',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
        ;
        $builder->add(
                'submit',
                SubmitType::class,
                ['attr' => ['class' => 'form-control'],'label' => 'Submit']
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
            'standalone' => false
        ]);
    }
}
