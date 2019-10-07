<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fullName',
                TextType::class,
                [
                    'attr' => ['class' => 'form-control contact','placeholder' => 'Name'], 'label' => false
                ])
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' => ['class' => 'form-control contact','placeholder' => 'Email'], 'label' => false
                ]
                
                )
            ->add(
                'message',
                TextareaType::class, 
                [
                    'attr' => ['class' => 'form-control message', 'rows' => 7,'placeholder' => 'Message'], 'label' => False
                ]
                )      
            ;

        if ($options['standalone']) {
            $builder->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => ['class' => "submit"], 
                    'label' => 'Send'
                ]
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'standalone' => false
        ]);
    }
}
