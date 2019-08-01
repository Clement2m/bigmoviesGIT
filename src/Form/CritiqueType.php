<?php

namespace App\Form;

use App\Entity\Critique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CritiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte_critique')
            ->add('name_user')
            //->add('film_id')
            //->add('create_at', ["label" => "Critique : "])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Critique::class,
        ]);
    }
}
