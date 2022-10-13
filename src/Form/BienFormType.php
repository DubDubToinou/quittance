<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom du bien'
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Adresse'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Ville'
                    ]
                ])
            ->add('codePostal', IntegerType::class, [
                'attr'=>[
                    'placeholder'=>'Code Postal'
                    ]
                ])
            ->add('prixLocation', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Montant Location'
                    ]
                ])
            ->add('prixCharge', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Montant Charge'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
