<?php

namespace App\Form;

use App\Entity\CompletedJobs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompletedJobsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('job', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('roadName', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('start', NumberType::class, [
                'attr' => ['class' => 'form-control', 'type'=>'number']
            ])
            ->add('finish', NumberType::class, [
                'attr' => ['class' => 'form-control', 'type'=>'number']
            ])
            ->add('measurement', TextType::class, [
                'disabled' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('quantity', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompletedJobs::class,
        ]);
    }
}
