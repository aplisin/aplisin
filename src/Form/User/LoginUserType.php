<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Username', 'required' => true, 'attr' => array('maxlength' => 32)))
            ->add('password', PasswordType::class, array('label' => 'Password', 'required' => true, 'attr' => array('maxlength' => 18)))
            ->add('submit', SubmitType::class, array('label' => 'Log In', 'attr' => array('class' => 'cd-btn cd-btn-primary')));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'authenticate';
    }
}