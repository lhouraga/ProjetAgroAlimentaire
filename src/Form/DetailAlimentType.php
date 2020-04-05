<?php

namespace App\Form;

use App\Entity\DetailAlimentRecu;
use App\Entity\Lot;
use App\Entity\TypeAliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DetailAlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder-> add('TypeAliment', EntityType::class, [
                      'class' => TypeAliment::class,
                      'choice_label' => function ($type) {
                       return $type->getType();
       }
   ])
            ->add('lot')
            ->add('NomAliment')
            ->add('PrixUnitaire')
            ->add('DatePeremption')
            ->add('QteRecu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailAlimentRecu::class,
        ]);
    }
}
