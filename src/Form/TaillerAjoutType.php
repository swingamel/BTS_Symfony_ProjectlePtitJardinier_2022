<?php

namespace App\Form;

use App\Form\DevisType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Haie;

class TaillerAjoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('longueur', NumberType::class, array('invalid_message'=>'Vous devez saisir un nombre !'))
        ->add('hauteur', NumberType::class, array('invalid_message'=>'Vous devez saisir un nombre !'))
        ->add('haie', EntityType::class, ['label' => 'Haie', 'class' => Haie::class, 'choice_label' => 'nom']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
