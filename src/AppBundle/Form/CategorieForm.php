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

class CategorieForm extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre', TextType::class, [
                    'label'=>'Titre'
                ])
                ;
        
    }
    public function configureOption(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class'=>'AppBundle\Entity\Categorie']);
    }
}
