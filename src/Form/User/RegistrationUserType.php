<?php

namespace App\Form\User;

use App\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Username', 'required' => true, 'attr' => array('maxlength' => 32)))
            ->add('email', EmailType::class, array('label' => 'Email', 'required' => true, 'attr' => array('maxlength' => 64)))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'attr' => array('maxlength' => 18),
                'required' => true,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Confirm Password')
            ))
            ->add('submit', SubmitType::class, array('label' => 'Sign Up', 'attr' => array('class' => 'cd-btn cd-btn-primary')));
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'user';
    }
}