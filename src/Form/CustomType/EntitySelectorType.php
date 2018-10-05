<?php

namespace App\Form\CustomType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitySelectorType extends AbstractType
{
    public function getParent()
    {
        return EntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('class');
        $resolver->setRequired('name');
        $resolver->setRequired('choice_label');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add($options['name'], $this->getParent(), [
            'expanded' => false,
            'multiple' => false,
            'class' => $options['class'],
            'choice_label' => $options['choice_label']
        ]);
    }
}