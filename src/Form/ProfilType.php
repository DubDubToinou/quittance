<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'error_bubbling' => true,
                'attr'=>[
                    'placeholder'=>'Email',
                ]
            ])
            ->add('nom', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Prenom',
                    ]
                ])
            ->add('adresse', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Adresse',
                    ]
                ])
            ->add('ville',TextType::class, [
                'attr'=>[
                    'placeholder'=>'Ville'
                    ]
                ])
            ->add('codePostal',IntegerType::class, [
                'attr'=>[
                    'placeholder'=>'Code Postal',
                    ]
                ])
            ->add('imageFile', VichImageType::class, [
                'label'=>'Photo de Profil: ',
                'allow_delete'=>false,
                'download_label'=>false,
                'download_uri'=>false,
                'required'=>false,
                'attr'=>[
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
