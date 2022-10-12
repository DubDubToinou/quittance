<?php

namespace App\Form;

use App\Entity\User;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'error_bubbling'=> true,
                'attr'=>['placeholder'=>'Email']
                            ])
            ->add('nom', TextType::class, [
                'label'=>'*Nom',
                'error_bubbling'=>true,
                'attr'=>['placeholder'=>'Nom']
            ])
            ->add('prenom', TextType::class, [
                'label'=>'*Prenom :',
                'error_bubbling'=>true,
                'attr'=>['placeholder'=>'Prenom']
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller

                'mapped' => false,
                'label'=>'Mot de passe :',
                'error_bubbling'=>true,
                'required'=>true,
                'attr' => ['autocomplete' => 'new-password',
                            'placeholder'=>'Mot de Passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un mot de passe'
                    ]),
                //   new Length([
                //       'min' => 6,
                //       'minMessage' => 'Le mot de passe ne contient pas {{ limit }} caractères',
                //       // max length allowed by Symfony for security reasons
                //       'max' => 4096,
                //   ]),
                    new Regex(
                        "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/",
                        "Mot de passe : 8 Caractères / Majuscules / Caractères spéciaux",
                    ),
                ],
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
