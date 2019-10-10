<?php

namespace App\Form;

use App\Entity\About;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AboutFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',
                TextareaType::class, 
                [
                "label" => 'Titre',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('paragraphe1',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #1',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('paragraphe2',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #2',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('paragraphe3',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #3',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('paragraphe4',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #4',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
             ->add('paragraphe5',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #5',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
             ->add('paragraphe6',
                TextareaType::class, 
                [
                "label" => 'Paragraphe #6',
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
            'data_class' => About::class,
            'standalone' => false
        ]);
    }
}
