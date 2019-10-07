<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RunawayFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'label',
                    TextType::class, 
                    [
                    "label" => 'Nom de la catégorie',
                    'attr' => ['class' => 'form-control border-300 bg-light'],
                    
                ])
            ->add('photo1',
                EntityType::class, 
                [
                    'class' => Project::class, 
                    'expanded' => false,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'form-control filter-list-input'],
                    'data_class' => null,
                    'choices' => $options['category']->getProjects(),
                    'choice_label' => 'label',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.label', 'ASC')
                            ;
                            
                    }
                ])
                ->add('photo2',
                EntityType::class, 
                [
                    'class' => Project::class, 
                    'expanded' => false,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'form-control filter-list-input'],
                    'data_class' => null,
                    'choices' => $options['category']->getProjects(),
                    'choice_label' => 'label',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.label', 'ASC')
                            ;
                            
                    }
                ])
                ->add('photo3',
                EntityType::class, 
                [
                    'class' => Project::class, 
                    'expanded' => false,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'form-control filter-list-input'],
                    'data_class' => null,
                    'choices' => $options['category']->getProjects(),
                    'choice_label' => 'label',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.label', 'ASC')
                            ;
                            
                    }
                ])
            // ->add('photo2')
            // ->add('photo3')
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
            'data_class' => Category::class,
            'standalone' => false,
            'category' => []
        ]);
    }
}
