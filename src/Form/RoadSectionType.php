<?php

namespace App\Form;

use App\Entity\RoadSection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoadSectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roadNumber', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('roadName', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('roadStart', NumberType::class, [
                'attr' => ['class' => 'form-control', 'type'=>'number']
            ])
            ->add('roadFinish', NumberType::class, [
                'attr' => ['class' => 'form-control', 'type'=>'number']
            ])
            ->add('roadLevel', NumberType::class, [
                'attr' => ['class' => 'form-control', 'type'=>'number']
            ])
            ->add('roadType', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoadSection::class,
        ]);
    }
}
