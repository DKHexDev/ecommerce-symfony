<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'help' => 'Ex.  John Doe',
                'attr' => [
                    'placeholder' => 'Nom',
                ]
            ])
            ->add('description', TextareaType::class)
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'help' => 'Insérer le prix du produit',
                'attr' => [
                    'placeholder' => 'Prix',
                ]
            ])
            ->add('liked', CheckboxType::class, [
                'label' => 'Coup de coeur',
            ])
            /*->add('image', FileType::class, [
                'label' => 'Image',
                'help' => 'Image de couverture du produit',
                'attr' => [
                    'placeholder' => 'Image de couverture'
                ]
            ])*/
            ->add('promotion', IntegerType::class, [
                'label' => 'Promotion',
                'help' => 'Insérer le montant de la promotion',
                'attr' => [
                    'placeholder' => 'Promotion'
                ]
            ])
            ->add('category', null, [
                'choice_label' => 'name', // propriété name de la classe Category 
            ])
            ->add('color', null, [
                'choice_label' => 'name',
                'expanded' => true, // Checkboxes au lieu de select multiple
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
