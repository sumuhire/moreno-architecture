<?php

namespace App\Form;

use App\Entity\Dolci;
use App\Entity\Piatto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class DolciFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'plat1',
                EntityType::class, 
                [
                    'class' => Piatto::class,
                    'choice_label' => 'italien',
                    'attr' => ['class' => 'form-control form-control'],
                    'label'=> false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.italien', 'ASC')
                            ->where('p.piattoType = 4');
                    }
                ])
            ->add(
                'plat2',
                EntityType::class, 
                [
                    'class' => Piatto::class,
                    'choice_label' => 'italien',
                    'attr' => ['class' => 'form-control form-control'],
                    'label'=> false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.italien', 'ASC')
                            ->where('p.piattoType = 4');
                    }     
                ])
            ->add(
                'plat3',
                EntityType::class, 
                [
                    'class' => Piatto::class,
                    'choice_label' => 'italien',
                    'attr' => ['class' => 'form-control form-control'],
                    'label'=> false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.italien', 'ASC')
                            ->where('p.piattoType = 4');
                    }

                ])
            ->add(
                'plat4',
                EntityType::class, 
                [
                    'class' => Piatto::class,
                    'choice_label' => 'italien',
                    'attr' => ['class' => 'form-control form-control'],
                    'label'=> false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.italien', 'ASC')
                            ->where('p.piattoType = 4');
                    }
                ])
        ;

        if ($options['standalone']) {
            $builder->add(
                'submit',
                SubmitType::class,
                ['attr' => ['class' => "btn btn-primary btn-lg"], 'label' => 'Salvo']
            );
        }    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dolci::class,
            'standalone' => false
        ]);
    }
}
