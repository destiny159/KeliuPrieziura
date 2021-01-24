<?php

namespace App\Form;

use App\Entity\JobCypher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobCypherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cypher', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('measurement', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobCypher::class,
        ]);
    }
}
