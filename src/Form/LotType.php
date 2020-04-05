<?php

namespace App\Form;

use App\Entity\Lot;
use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fournisseur', EntityType::class, [
                 'class' => Fournisseur::class,
                 'choice_label' => function ($fournisseur) {
                 return $fournisseur->getSociete();
            }
        ]);
            
           
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lot::class,
        ]);
    }
}
