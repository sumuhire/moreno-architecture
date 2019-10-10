<?php

namespace App\Form;

use App\Entity\Job;
use App\Form\JobMissionFormType;
use App\Form\JobProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class JobFormType extends AbstractType
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label',
             TextType::class, [
                "label" => 'Dénomination du job',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('intro',
             TextType::class, [
                "label" => 'Introduction',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add('type',
             TextType::class, [
                "label" => 'Type de contrat',
                'attr' => ['class' => 'form-control border-300 bg-light'],
                
            ])
            ->add(
                'profils', 
                CollectionType::class, 
                    [
                        'entry_type' => JobProfileFormType::class,
                        'entry_options' => [
                            
                            'label' => false
                            
                            ],
                        'by_reference' => false,
                        'allow_add' => true,
                        'allow_delete' => true
                        
                    ]
                )
            ->add(
                'missions', 
                CollectionType::class, 
                    [
                        'entry_type' => JobMissionFormType::class,
                        'entry_options' => [
                            
                            'label' => false
                            
                            ],
                        'by_reference' => false,
                        'allow_add' => true,
                        'allow_delete' => true
                        
                    ]
                )
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
            'data_class' => Job::class,
            'standalone' => false
        ]);
    }
}
