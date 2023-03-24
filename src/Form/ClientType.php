<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Client (*)'
            ])
            ->add('imageFile', FileType::class, [
                'label' => "Logo du Client (taille max. 1000x1000)"
            ])
            ->add('website', TextType::class, [
                'label' => 'Site web du Client',
                'required' => false
            ])
            ->add('email', TextType::class, [
                'label' => 'Email du Client',
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numéro tél. du Client',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
