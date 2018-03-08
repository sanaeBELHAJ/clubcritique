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
use AppBundle\Entity\Article;
use AppBundle\Entity\Articleproprietaire;
use AppBundle\Entity\Membre;
use AppBundle\Form\ArticleForm;

class ArticleController  extends Controller{
    

    /**
     * @Route("/newArtcile", name="article_new")
    */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleForm::class, $article);
      
        $form->handleRequest($request);
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        if($form->isValid()){
            $data = $request->get('article_form');

            if(isset($_POST['date_sortie'])){
                $date = new \DateTime($_POST['date_sortie']);
                $article->setDate_sortie($date);
            }
            $article->setIdCategorie(intval($data['idCategorie']));
            if(isset($_FILES['image'])){
                $uploaddir = 'ressource/article/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                        $article->setImage($_FILES['image']['name']);
                        echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                        echo "la taille de l'image dépasse la taille autorisé.";
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article_all', ['id'=>$session->get('id'),'membre'=>$membre]);
            
        }
        return $this->render('contenu/add.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
        ]);
    }
     /**
     * @Route("/articleList", name="article_all")
    */
    public function allArticlesAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $articles = $em->getRepository('AppBundle:Article')->findAll();

        return $this->render('contenu/articles.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'articles'=>$articles
        ]);
    }
     /**
     * @Route("/editArticle/{id}", name="article_edit")
    */
    public function editAction(Request $request , $id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $article = $em->getRepository('AppBundle:Article')->find($id);

        $form = $this->createForm(ArticleForm::class, $article);
        $form->handleRequest($request);
        if($form->isValid()){
           $data = $request->get('article_form');
           if(isset($_POST['date_sortie'])){
                $date = new \DateTime($_POST['date_sortie']);
                $article->setDate_sortie($date);
            }
            $article->setIdCategorie(intval($data['idCategorie']));
            if(isset($_FILES['image'])){
                $uploaddir = 'ressource/article/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                        $article->setImage($_FILES['image']['name']);
                        echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                        echo "la taille de l'image dépasse la taille autorisé.";
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article_all', ['id'=>$session->get('id'),'membre'=>$membre]);
            

        }
         return $this->render('contenu/add.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'article' => $article,
            'id_membre' => $session->get('id'),
        ]);
    }
     /**
     * @Route("/deleteArticle/{id}", name="article_delete")
    */
    public function deleteAction(Request $request , $id)
    {
       $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $article = $em->getRepository('AppBundle:Article')->find($id);
        if($article!= null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
            $this->addFlash('success', "article supprimé!");
        }


            return $this->redirectToRoute('article_all', ['id'=>$session->get('id'),'membre'=>$membre]);
    }
    /**
     * @Route("/articleView/{idA}", name="article_view")
    */
    public function viewAction(Request $request,$idA)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
            $verifier = $em->getRepository('AppBundle:Articleproprietaire')->findOneBy(
                        array("id_membre"=>$session->get('id'),"id_article"=>$idA)
                        );
            if($verifier != null){
               $possede = 1; 
            }else{
                $possede = 0;
            }
            $article = $em->getRepository('AppBundle:Article')->find($idA);
            return $this->render('contenu/view.html.twig',[
            'membre' => $membre,
            'possede' => $possede,
            'id_membre' => $session->get('id'),
            'article'=>$article
            ]);
        }else{
            $membre = new Membre();
            $article = $em->getRepository('AppBundle:Article')->find($idA);
            return $this->render('contenu/view.html.twig',[
                'membre' => $membre,
                'id_membre' => $session->get('id'),
                'article'=>$article
            ]);
        }
        
    }
    /**
     * @Route("/articlesbycateg/{id}", name="article_articlesbycateg")
    */
    public function articlesAction(Request $request,$id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        }else{
             $membre = new Membre();
        }
        if(isset($_POST['titre'])){
            $articles = $em->getRepository('AppBundle:Article')->findBy(array("idCategorie"=>$id, "titre"=>$_POST['titre']));
        }else{
            $articles = $em->getRepository('AppBundle:Article')->findBy(array("idCategorie"=>$id));
        }
          
        return $this->render('contenu/recherche.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'articles'=>$articles,
            'id_categorie'=>$id
        ]);
    }
    /**
     * @Route("/ArticleProprietaire", name="article_proprietaire")
    */
    public function ArticleProprietaireAction(Request $request)
    {
        $Articleproprietaire= new Articleproprietaire();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
            if(isset($_GET['idArticle'])){
                $verifier = $em->getRepository('AppBundle:Articleproprietaire')->findOneBy(
                        array("id_membre"=>$session->get('id'),"id_article"=>$_GET['idArticle'])
                        );
                if($verifier == null){
                    $Articleproprietaire->setId_article($_GET['idArticle']);
                    $Articleproprietaire->setId_membre($session->get('id'));
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Articleproprietaire);
                    $em->flush();
                }
            }
            return $this->redirectToRoute('article_view', ['idA'=>$_GET['idArticle'],'id'=>$session->get('id'),'membre'=>$membre]);
        }else{
            $membre= new Membre();
            return $this->render('default/404.html.twig',[
                'membre' => $membre,
            ]);
        }
    }
    /**
     * @Route("/ArticleProprietaireNo", name="article_proprietaireNo")
    */
    public function ArticleProprietaireNoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
            if(isset($_GET['idArticle'])){
                $verifier = $em->getRepository('AppBundle:Articleproprietaire')->findOneBy(
                        array("id_membre"=>$session->get('id'),"id_article"=>$_GET['idArticle'])
                        );
                if($verifier != null){
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($verifier);
                    $em->flush();
                    $this->addFlash('success', "article supprimé!");
                }
            }
            return $this->redirectToRoute('article_view', ['idA'=>$_GET['idArticle'],'membre'=>$membre]);
        }else{
            $membre= new Membre();
            return $this->render('default/404.html.twig',[
                'membre' => $membre,
            ]);
        }
    }
        
    }
    

