<?php

namespace App\Form;

use App\Entity\Kanji;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KanjiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caractere')
            ->add('cle')
            ->add('kunyomi')
            ->add('onyomi')
            ->add('stroke')
            ->add('sens')
            ->add('niveau')
            ->add('composant', EntityType::class, ["multiple"=> true, 'class' => Kanji::class, "required"=>false ])
            ->add('aPourComposant', EntityType::class, ["multiple"=> true, 'class' => Kanji::class, "required"=>false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Kanji::class,
        ]);
    }
}