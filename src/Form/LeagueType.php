<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\League;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeagueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class);

        if ($options['show_country_selector']) {
            $builder->add('country', EntityType::class, [
                'class' => Country::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name'
            ]);
        }

        $builder->add('numberOfClubs', IntegerType::class);
        $builder->add('leagueRanking', IntegerType::class);
        $builder->add('save', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary btn-fill'
            ]
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => League::class,
        ]);

        $resolver->setRequired('show_country_selector');
    }
}