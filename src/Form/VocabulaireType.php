<?php

namespace App\Form;

use App\Entity\Kanji;
use App\Entity\Compteur;
use App\Entity\Vocabulaire;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VocabulaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mot')
            ->add('kana')
            ->add('romaji')
            ->add('sens')
            ->add('contexte', CKEditorType::class)
            ->add('classe')
            ->add('jlpt')
            ->add('accent')
            ->add('kanji', EntityType::class, ["multiple"=> true, 'class' => Kanji::class, "required"=>false ])
            ->add('Compteur', EntityType::class, ["multiple"=> true, 'class' => Compteur::class, "required"=>false ])
            ->add('synonyme', EntityType::class, ["multiple"=> true, 'class' => Vocabulaire::class, "required"=>false ])
            ->add('synonymeAvec', EntityType::class, ["multiple"=> true, 'class' => Vocabulaire::class, "required"=>false ])
            ->add('antonyme', EntityType::class, ["multiple"=> true, 'class' => Vocabulaire::class, "required"=>false ])
            ->add('antonymeDe', EntityType::class, ["multiple"=> true, 'class' => Vocabulaire::class, "required"=>false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vocabulaire::class,
        ]);
    }
}
