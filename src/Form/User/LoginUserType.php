<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class LoginUserType extends AbstractType
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
            ->add('password', PasswordType::class, array('label' => $this->translator->trans('Password'), 'required' => true, 'attr' => array('maxlength' => 18)))
            ->add('submit', SubmitType::class, array('label' => $this->translator->trans('Log In'), 'attr' => array('class' => 'btn btn-primary btn-block')));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'authenticate';
    }
}