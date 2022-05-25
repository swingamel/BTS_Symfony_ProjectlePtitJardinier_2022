<?php

namespace App\Form;

use App\Entity\Haie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class HaieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('nom')
            ->add('prix', MoneyType::class, array('invalid_message'=>'Vous devez saisir un nombre !'))
            ->add('categorie', EntityType::class, ['label' => 'Categorie haie', 'class' => Categorie::class, 'choice_label' => 'libelle']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Haie::class,
        ]);
    }
}
