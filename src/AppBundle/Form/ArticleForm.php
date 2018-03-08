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
class ArticleForm extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('urlVendeur', TextType::class, [
                    'label'=>'Récuperation d\'article automatique',
                    'required'=>false,
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                ])
                ->add('titre', TextType::class, [
                    'label'=>'Titre'
                ])
                ->add('resume', TextareaType::class, [
                    'label'=>'Résumé'
                ])
                ->add('auteur', TextType::class, [
                    'label'=>'Auteur/Réalisateur',
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                ])
//                ->add('date_sortie', DateType::class, array(
//                    'widget' => 'single_text',
//                    'label'=>'Date de sortie',
//                    // 'attr' => array('class'=>"datepicker"),
//                    // this is actually the default format for single_text
//                    'format' => 'yyyy-MM-dd',
//                ))
                
                ->add('laune', ChoiceType::class, [
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label'=>'Mettre à La une',
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                ])
                ->add('idCategorie', EntityType::class, [
                    // query choices from this entity
                    'class' => 'AppBundle:Categorie',
                    'choice_label' => 'titre',
                    'label'=>'Categorie',
                    'attr'=>[ 'class'=>'form-control' ]
                ])
                ;
        
    }
    public function configureOption(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class'=>'AppBundle\Entity\Article']);
        
    }
}
