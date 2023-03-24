<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Partenaire (*)",
                'attr' => [
                    'placeholder' => "Saisir le nom du Partenaire"
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => "Image illustrative (taille max. 500x500)"
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Parlez brièvement du Partenaire',
                'required' => false,
                'attr' => [
                    'rows' => 3
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
