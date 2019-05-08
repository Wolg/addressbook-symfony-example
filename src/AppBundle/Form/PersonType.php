<?php
namespace AppBundle\Form;

use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

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
            ->add('picture', FileType::class, array(
                'data_class' => null,
                'required' => false,
                'constraints' => array(
                    new Image(array(
                        'maxSize' => '2M',
                        'mimeTypes' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                    )),
                ),
            ))
            ->add('submit', SubmitType::class)
            ->getForm();
        ;
    }
}