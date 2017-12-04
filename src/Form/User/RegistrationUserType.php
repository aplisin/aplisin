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
use Symfony\Component\Translation\TranslatorInterface;

class RegistrationUserType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => $this->translator->trans('Username'), 'required' => true, 'attr' => array('maxlength' => 32)))
            ->add('email', EmailType::class, array('label' => $this->translator->trans('Email'), 'required' => true, 'attr' => array('maxlength' => 64)))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'attr' => array('maxlength' => 18),
                'required' => true,
                'first_options' => array('label' => $this->translator->trans('Password')),
                'second_options' => array('label' => $this->translator->trans('Confirm Password'))
            ))
            ->add('submit', SubmitType::class, array('label' => $this->translator->trans('Sign Up'), 'attr' => array('class' => 'btn btn-primary btn-block')));
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'user';
    }
}