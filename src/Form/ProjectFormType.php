<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Activity;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label',
             TextType::class, [
                "label" => 'Nom du projet',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('intro',
             TextType::class, [
                "label" => 'Introduction du projet',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('areaHorsSol',
             TextType::class, [
                "label" => 'Hors-sol',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('areaSousSol',
             TextType::class, [
                "label" => 'Sous-sol',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('budget',
             TextType::class, [
                "label" => 'Budget',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('contractor',
             TextType::class, [
                "label" => "Maître d'oeuvre",
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('photo1',
                FileType::class,
                ["data_class" => null, "label" => "Photo #1"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('photo2',
                FileType::class,
                ["data_class" => null, "label" => "Photo #2"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('photo3',
                FileType::class,
                ["data_class" => null, "label" => "Photo #3"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('photo4',
                FileType::class,
                ["data_class" => null, "label" => "Photo #4"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('photo5',
                FileType::class,
                ["data_class" => null, "label" => "Photo #5"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('category',
                EntityType::class, 
                [
                    'class' => Category::class, 
                    'choice_label' => 'label',
                    'expanded' => false,
                    'multiple' => false,
                    'label' => 'Type',
                    'attr' => ['class' => 'form-control filter-list-input'],
                    'data_class' => null
                ])
            ->add('activities',
                EntityType::class, 
                [
                    'class' => Activity::class, 
                    'choice_label' => 'label',
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Type',
                    'attr' => ['class' => ''],
                    'data_class' => null
                ])
            ;
            if ($options['standalone']) {

            $builder->add(
                'submit',
                SubmitType::class,
                ['attr' => ['class' => 'form-control'],'label' => 'Submit']
            );
        }
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'standalone' => false
        ]);
    }
}
