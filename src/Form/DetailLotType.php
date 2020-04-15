<?php

namespace App\Form;

use App\Entity\TypeAliment;
use App\Entity\Lot;
use App\Entity\DetailLotRecu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DetailLotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       /* ->add('lot', EntityType::class, [
            'class' => Lot::class,
            'choice_label' => function ($type) {
             return $type->getId();
            }
        ])*/
            ->add('TypeAliment', EntityType::class, [
                'class' => TypeAliment::class,
                'choice_label' => function ($type) {
                 return $type->getType();
                }
            ])
           
            ->add('NomAliment')
            ->add('PrixUnitaire')
            ->add('DatePeremption')
            ->add('QteRecu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailLotRecu::class,
        ]);
    }
}
