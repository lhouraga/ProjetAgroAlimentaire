<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\TypeRecette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomRecette')
            ->add('typeRecette', EntityType::class, [
                'class' => TypeRecette::class,
                'choice_label' => function ($type) {
                 return $type->getLibelle();
                }
   ])

            ->add('duree')
            ->add('preparation');
                                
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
