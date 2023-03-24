<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Testimonial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TestimonialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entreprise', EntityType::class, [
                'class' => Client::class
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom complet'
            ])
            ->add('grade', TextType::class, [
                'label' => 'Fonction'
            ])
            ->add('imageFile', FileType::class, [
                'label' => "Photo de la personne (taille max. 100x100)"
            ])
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Testimonial::class,
        ]);
    }
}
