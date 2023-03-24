<?php

namespace App\Form;

use App\Entity\News;
use App\Entity\CategoryNews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('publiedAt', DateTimeType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
            ])
            ->add('name', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('imageFile', FileType::class, [
                'label' => "Image illustrative "
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Decrivez l\'article à publier',
                'attr' => [
                    'rows' => 5
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => CategoryNews::class,
                'label' => 'Catégorie'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
