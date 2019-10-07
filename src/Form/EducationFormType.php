<?php

namespace App\Form;

use App\Entity\Education;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EducationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('school',
             TextType::class, [
                "label" => 'Ecole',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('degree',
             TextType::class, [
                "label" => 'inti',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('start',
                DateType::class,
                [
                    'widget' => 'choice',
                    'label' => 'Ending year', 
                    'years' => range(2000,2020),
                    // 'placeholder' => array(
                    //     'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    // )
                    
                ])
            ->add('end',
                DateType::class,
                [
                    'widget' => 'choice',
                    'label' => 'Ending year', 
                    'years' => range(2000,2020),
                    // 'placeholder' => array(
                    //     'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    // )
                    
                ])
            ->add('schoolPicture',
            FileType::class,
                ["data_class" => null, "label" => "Photo de l'employé(e)"],
                ["attr" => ["class" => "form-control"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Education::class,
        ]);
    }
}
