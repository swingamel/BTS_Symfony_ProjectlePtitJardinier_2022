<?php

namespace App\Form;

use App\Entity\TypeClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypeClientSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeClientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('typeClient', EntityType::class, ['class' => TypeClient::class, 'choice_label' => 'type_client', 'label' => 'Type de Client   ']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeClientSearch::class,
        ]);
    }
}
