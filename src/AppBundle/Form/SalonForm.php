<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class SalonForm extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre_salon', TextType::class, [
                    'label'=>'Titre de salon',
                    'required'=>false,
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                ])
                ->add('description', TextType::class, [
                    'label'=>'Description'
                ])
                ->add('date_debut', TextType::class, [
                    'label'=>'date_debut',
                    'attr'=>[
                        'class'=>'datepicker'
                    ],
                ])
                ->add('date_fin', TextType::class, [
                    'label'=>'Auteur/Réalisateur',
                     'attr'=>[
                        'class'=>'datepicker'
                    ],
                ])
                ->add('id_article', EntityType::class, [
                    // query choices from this entity
                    'class' => 'AppBundle:Article',
                    'choice_label' => 'titre',
                    'label'=>'Article',
                    'attr'=>[ 'class'=>'form-control' ]
                ])
                ;
        
    }
    public function configureOption(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class'=>'AppBundle\Entity\Article']);
        
    }
}
