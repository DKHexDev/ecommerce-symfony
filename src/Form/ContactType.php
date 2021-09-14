<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
                'help' => 'Toto',
                'attr' => [
                    'placeholder' => 'Votre nom',
                ]
            ])
            ->add('email', null, [
                'help' => 'Nous ne partagerons pas votre email',
                'attr' => [
                    'placeholder' => 'Votre email',
                ]
            ])
            ->add('message', TextareaType::class)
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'placeholder' => 'Choisir un pays',
            ])
            //->add('askedAt', null, [
            //    'year' => range(2021, 2030) //
            //])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}