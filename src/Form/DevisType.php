<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\Pays;
use App\Repository\PaysRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom *',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre prénom (facultatif)',
                'required' => false,
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email *',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone *',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('entreprise', TextType::class, [
                'label' => 'Votre structure ou Entreprise',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('website', TextType::class, [
                'label' => 'Site web (facultatif)',
                'required' => false,
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville *',
                'attr' => [
                    'placeholder' => ''
                ]
            ])

            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'label' => 'Pays *',
                'placeholder' => '-- Sélectionnez votre pays --',
                'query_builder' => function (PaysRepository $paysRepository) {
                    return $paysRepository->createQueryBuilder('p')->orderBy("p.name", "ASC");
                },
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => 'Sélectionnez votre pays'
                ]
            ])->add('description', TextareaType::class, [
                'label' => "Merci de nous fournir plus d'informations sur votre demande (imprimante, caméra IP,ruban couleur ou monochrome, type de carte, quantité...) *",
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Exemple: j\'ai besoin d\'une imprimante Primacy 2, deux rubans YMCKO et 500 cartes vierges pour les impressions des cartes d\étudiant'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
