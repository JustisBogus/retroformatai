<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('username', TextType::class, ['label' => 'Vartotojo Vardas *'])
                ->add('email', EmailType::class, ['label' => 'e-paštas *'])
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Slaptažodis *'],
                    'second_options' => ['label' => 'Pakartotas Slaptažodis *']
                ])
                ->add('fullName', TextType::class, ['label' => 'Pilnas Vardas'])
                ->add('location', ChoiceType::class, [
                    'choices' => [
                        'Miestas',
                        'Vilnius',
                        'Kaunas',
                        'Klaipėda',
                        'Šiauliai',
                        'Panevėžys',
                        'Alytus',
                        'Mažeikiai',
                        'Jonava',
                        'Utena',
                        'Kėdainiai'
                    ]
                ])
                ->add('termsAgreed', CheckboxType::class, [
                    'mapped' => false,
                    'constraints' => new IsTrue(),
                    'label' => 'Sutinku su privatumo politika *',
                ])
                ->add('Register', SubmitType::class, ['label' => 'Registruotis']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
            $resolver->setDefaults([
                'data_class' => User::class
            ]);
    }
}