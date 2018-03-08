<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Membre;
use AppBundle\Form\CategorieForm;


class CategorieController  extends Controller{
    

    /**
     * @Route("/newCategorie", name="categorie_new")
    */
    public function createAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieForm::class, $categorie);
        $form->handleRequest($request);
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        if($form->isValid()){
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_all', ['id'=>$session->get('id'),'membre'=>$membre]);


        }
        return $this->render('categorie/add.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
        ]);
    }
    /**
     * @Route("/editCategorie/{id}", name="categorie_edit")
    */
    public function editAction(Request $request , $id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $categorie = $em->getRepository('AppBundle:Categorie')->find($id);

        $form = $this->createForm(CategorieForm::class, $categorie);
        $form->handleRequest($request);
        if($form->isValid()){
           $em->persist($categorie);
           $em->flush();
           $this->addFlash('success', "Vos informations personnelles sont à jour!");
           return $this->redirectToRoute('categorie_all', ['id'=>$session->get('id'),'membre'=>$membre]);

        }
         return $this->render('categorie/add.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
        ]);
    }
    /**
     * @Route("/categorieList", name="categorie_all")
    */
    public function allCategoriesAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $categories = $em->getRepository('AppBundle:Categorie')->findAll();

        return $this->render('categorie/categories.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'categories'=>$categories
        ]);
    }
    /**
     * @Route("/categories", name="categorie_categories")
    */
    public function categoriesAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        }else{
            $membre = new Membre();
        }
        $categories = $em->getRepository('AppBundle:Categorie')->findAll();
        $articles = array();
        $nbCategorie=array();
        foreach ($categories as $categorie){
            //$articles[] = $em->getRepository('AppBundle:Article')->findBy(array("idCategorie"=>$categorie->getId()));
            $query = $em->createQuery(
		        "SELECT count(distinct a.id)
			FROM AppBundle:Article a
			WHERE a.idCategorie=:idCategorie"
                    )->setParameter('idCategorie', $categorie->getId());

            $nbCategorie[$categorie->getId()] = $query->getResult();
        }
        foreach ($nbCategorie as $key=>$value){
                foreach ( $value as $v){
                     $articles[$key] = $v[1];
                }
        }
        return $this->render('contenu/contenu.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'categories'=>$categories,
            'nbCategorie'=>$articles
        ]);
    }
    
    
}
