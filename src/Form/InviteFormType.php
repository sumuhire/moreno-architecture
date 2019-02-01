<?php

namespace App\Form;

use App\Entity\Invite;
use App\Form\SchoolUserFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InviteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 
                TextType::class,
                ['attr' => ['class' => 'form-control filter-list-input']]
                )
            ->add(
                'schoolUser', 
                CollectionType::class, 
                    [
                        'entry_type' => SchoolUserFormType::class,
                        'entry_options' => [
                            
                            'label' => false
                            
                            ],
                    ]
                )      
        ;

        if ($options['standalone']) {
            $builder->add(
                'submit',
                SubmitType::class,
                ['attr' => ['class' => 'btn btn-warning btn-block']]
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invite::class,
            "standalone" => false
        ]);
    }
}
