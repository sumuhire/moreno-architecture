<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Employee;
use App\Entity\Language;
use App\Form\EducationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EmployeeFormType extends AbstractType
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',
                    TextType::class, 
                    [
                    "label" => 'Prénom',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('intro',
                    TextType::class, 
                    [
                    "label" => 'intro',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('lastname',
                    TextType::class, 
                    [
                    "label" => 'Nom de famille',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('job',
                    TextType::class, 
                    [
                    "label" => 'Job dénomination',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('phoneNumber',
                    TextType::class, 
                    [
                    "label" => 'Téléphone mobile professionel',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('email',
                    TextType::class, 
                    [
                    "label" => 'E-mail',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            // ->add('experiences')

            ->add('picture',
            FileType::class,
                ["data_class" => null, "label" => "Photo de l'employé(e)"],
                ["attr" => ["class" => "form-control"]
            ])
            ->add('languages',
            EntityType::class, 
                [
                'class' => Language::class, 
                'expanded' => true,
                'multiple' => true,
                'label' => false,
                'attr' => ['class' => 'form-control filter-list-input'],
                'data_class' => null,
                'choice_label' => 'label',
 
            ])
            ->add('projects',
            EntityType::class, 
                [
                'class' => Project::class, 
                'expanded' => false,
                'multiple' => true,
                'label' => false,
                'attr' => ['class' => 'form-control filter-list-input'],
                'data_class' => null,
                'choice_label' => 'label',

            ])
            ->add(
                'education', 
                CollectionType::class, 
                    [
                        'entry_type' => EducationFormType::class,
                        'entry_options' => [
                            
                            'label' => false
                            
                            ],
                        'by_reference' => false,
                        'allow_add' => true,
                        'allow_delete' => true
                        
                    ]
                )
        ;

        if ($options['standalone']) {
            $builder->add(
                'submit',
                SubmitType::class,
                ['attr' => ['class' => "btn btn-outline-warning mt-3"], 'label' => 'Save All']
            );
        }    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
            'standalone' => false
        ]);
    }
}
