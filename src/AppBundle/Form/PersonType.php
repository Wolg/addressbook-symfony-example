<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('address', TextareaType::class)
            ->add('zip', TextType::class)
            ->add('city', TextType::class)
            ->add('country', TextType::class)
            ->add('phone_number', TextType::class)
            ->add('birthday', DateType::class)
            ->add('email', EmailType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        ;
    }
}