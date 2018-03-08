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
use AppBundle\Entity\Salon;
use AppBundle\Form\SalonForm;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Note;
use AppBundle\Entity\Chatsalon;
use AppBundle\Entity\Noteuser;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Amis;
use AppBundle\Entity\Moderateur;
use Symfony\Component\HttpFoundation\JsonResponse;

class SalonController  extends Controller{
    

    /**
     * @Route("/newSalon", name="salon_new")
    */
    public function createAction(Request $request)
    {
        $salon = new Salon();
        $form = $this->createForm(SalonForm::class, $salon);
      
        $form->handleRequest($request);
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        if($form->isValid()){
            $data = $request->get('salon_form');
           // var_dump($data['date_debut']);
            if(isset($data['date_debut'])){
                $date = new \DateTime($data['date_debut']);
                $salon->setDateDebut($date);
            }
            if(isset($data['date_fin'])){
                $date = new \DateTime($data['date_fin']);
                $salon->setDateFin($date);
            }
           // die;
            $salon->setIdArticle(intval($data['id_article']));
           
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($salon);
            $em->flush();
            return $this->redirectToRoute('salon_all', ['id'=>$session->get('id'),'membre'=>$membre]);
            
        }
        return $this->render('salon/create.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
        ]);
    }
    /**
     * @Route("/salonList", name="salon_all")
    */
    public function allSalonAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $salons = $em->getRepository('AppBundle:Salon')->findAll();
        $articles = $em->getRepository('AppBundle:Article')->findAll();

        return $this->render('salon/salonList.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'salons'=>$salons,
            'articles'=>$articles,
        ]);
    }
    /**
     * @Route("/salons", name="salon_salons")
    */
    public function salonsAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->get('doctrine')->getManager();
	$query1 = $em->createQuery(
		        "SELECT s
			FROM AppBundle:Salon s
			WHERE s.date_debut >= :date"
	   )->setParameter('date', new \DateTime());
        
	$NextSalon = $query1->getResult();
        
	$query2 = $em->createQuery(
		        "SELECT s
			FROM AppBundle:Salon s
			WHERE s.date_debut <= :date and s.date_fin >= :date"
	   )->setParameter('date', new \DateTime());
        
	$NowSalon = $query2->getResult();
        
	$query3 = $em->createQuery(
		        "SELECT s
			FROM AppBundle:Salon s
			WHERE s.date_fin <= :date"
	   )->setParameter('date', new \DateTime());
        
	$PreviousSalon = $query3->getResult();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        }else{
            $membre = new Membre();
        }
        $idParticipant = array();
        if($NowSalon!=null){
            foreach($NowSalon as $salon){
                $participant= $em->getRepository('AppBundle:Participant')->findBy(
                        array('id_salon'=>$salon->getId())
                        );
                foreach($participant as $p){
                    $idParticipant[$salon->getId()] = array($p->getIdMembre());
                }
            }
        }
        //$salons = $em->getRepository('AppBundle:Salon')->findAll();
        $articles = $em->getRepository('AppBundle:Article')->findAll();
        $participants= $em->getRepository('AppBundle:Participant')->findAll();
        return $this->render('salon/salons.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'salonsEncours'=>$NowSalon,
            'salonsSuivant'=>$NextSalon,
            'salonsPasse'=>$PreviousSalon,
            'idParticipant'=>$idParticipant,
            'participants'=>$participants,
            'articles'=>$articles,
        ]);
    }
    /**
     * @Route("/editSalon/{id}", name="salon_edit")
    */
    public function editAction(Request $request , $id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $salon = $em->getRepository('AppBundle:Salon')->find($id);
       // var_dump($salon->getDateDebut()->format('j F, Y'));
        $salon->setDateDebut($salon->getDateDebut()->format('j F, Y'));
        $salon->setDateFin($salon->getDateFin()->format('j F, Y'));
        $form = $this->createForm(SalonForm::class, $salon);
        $form->handleRequest($request);
        if($form->isValid()){
          $data = $request->get('salon_form');
           // var_dump($data['date_debut']);
            if(isset($data['date_debut'])){
                $date = new \DateTime($data['date_debut']);
                $salon->setDateDebut($date);
            }
            if(isset($data['date_fin'])){
                $date = new \DateTime($data['date_fin']);
                $salon->setDateFin($date);
            }
           // die;
            $salon->setIdArticle(intval($data['id_article']));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($salon);
            $em->flush();
            return $this->redirectToRoute('salon_all', ['id'=>$session->get('id'),'membre'=>$membre]);
            

        }
         return $this->render('salon/create.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
        ]);
    }
     /**
     * @Route("/deleteSalon/{id}", name="salon_delete")
    */
    public function deleteAction(Request $request , $id)
    {
       $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $participants = $em->getRepository('AppBundle:Participant')->findBy(array('id_salon'=>$id));
        if($participants != null){
            foreach($participants as $participant){
                $em = $this->getDoctrine()->getManager();
                $em->remove($participant);
                $em->flush();
                $this->addFlash('success', "participant supprimé!");
            }
        }
        $salon = $em->getRepository('AppBundle:Salon')->find($id);
        if($salon!= null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($salon);
            $em->flush();
            $this->addFlash('success', "article supprimé!");
        }
        return $this->redirectToRoute('salon_all', ['id'=>$session->get('id'),'membre'=>$membre]);
        }
    /**
     * @Route("/noteSalon/{id}", name="salon_note")
    */
    public function noterSalonAction(Request $request , $id)
    {
       $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $note = new Note();
        $note->setIdArticle($id);
        $note->setIdMembre($session->get('id'));
        if(isset($_GET['note'])){
            $note->setNote($_GET['note']);
            $em->persist($note);
            $em->flush();
        }
        if(isset($_GET["idSalon"])){
            $participant = $em->getRepository('AppBundle:Participant')->findOneBy(
                    array(
                        "id_membre"=>$session->get('id'),
                        "id_salon" => $_GET["idSalon"]
                    )
                    );
            if($participant==null){
                $participant = new Participant();
                $participant->setIdMembre($session->get('id'));
                $participant->setIdSalon($_GET["idSalon"]);
                $em->persist($participant);
                $em->flush();
            }
            return $this->redirectToRoute('salon_chat', ['idSalon'=>$participant->getIdSalon(),'id'=>$session->get('id'),'membre'=>$membre]);
        }else{
            $membre= new Membre();
            return $this->render('default/404.html.twig',[
                'membre' => $membre,
            ]);
        }
       
    }  
    /**
     * @Route("/chat/{idSalon}", name="salon_chat")
    */
    public function chatAction(Request $request , $idSalon)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        //tester si l'id existe dans la table participant avant d'acceder
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));

            $messages = $em->getRepository('AppBundle:Chatsalon')->findBy(array('id_salon' => $idSalon),array('date' => 'ASC'));
            $participants = $em->getRepository('AppBundle:Participant')->findBy(array('id_salon' => $idSalon));
            $moderateurs = $em->getRepository('AppBundle:Moderateur')->findBy(array('moderateur' => $idSalon));
            //recuper les id des moderateur de ce salon 
            $idModeteurs = array();
            if($moderateurs != null){
                foreach($moderateurs as $moderateur){
                    $idModeteurs[] = $moderateur->getIdMembre();
                }
            }
          
            //recuperer les id des participant 
            $participantsId= array();
            foreach($participants as $participant){
                $participantsId[] = $participant->getIdMembre();
            }
            //recuperation des amis
            $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
            
            // query for a single product matching the given name and price
            $membre1 = $repository->findBy(
                    array('id_membre1' =>$session->get('id'),'accepter' =>1)
                );
            $amisId = array();
            foreach($membre1 as $m1){
                $amisId[] = $m1->getId_membre2();
            }
            $membre2 = $repository->findBy(
                    array('id_membre2' =>$session->get('id'),'accepter' =>1)
                );
                //var_dump($membre2);
            foreach($membre2 as $m2){
                $amisId[] = $m2->getId_membre1();
            }
            $mesamis = array();
            foreach($amisId as $id){
                if(!in_array($id, $participantsId)){
                    $mesamis[] = $id;
                }
            }
           // var_dump($mesamis);
           // die;
            $salon = $em->getRepository('AppBundle:Salon')->find($idSalon);
            if($salon !=null){
                $article = $em->getRepository('AppBundle:Article')->find($salon->getIdArticle());
            }else{
                $article =null;
            }
            $membres= array();
            $globalMembres = $em->getRepository('AppBundle:Membre')->findAll();
            if(isset($participants) && $participants!=null){
                foreach($participants as $participant){
                    $membres[] = $em->getRepository('AppBundle:Membre')->find($participant->getIdMembre());
                }
            }
            return $this->render('salon/chat.html.twig',[
                'membre' => $membre,
                'idSalon'=>$idSalon,
                'messages'=>$messages,
                'membres'=>$membres,
                'mesamis'=>$mesamis,
                'moderateurs'=>$idModeteurs,
                'globalMembres'=>$globalMembres,
                'salon'=>$salon,
                'article'=>$article,
                'id_membre' => $session->get('id'),
                'monstatut' => $membre->getStatut(),
            ]);
        }else{
            //membre_login
            return $this->redirectToRoute('membre_login');

        }
    }  
    /**
     * @Route("/sendMessage/{idSalon}", name="chat_send")
    */
    public function sendMessageAction(Request $request , $idSalon)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $message = new Chatsalon();
        if(isset($_POST['msg'])){
            $message->setIdSalon($idSalon);
            $message->setIdMembre($session->get('id'));
            $message->setMsg($_POST['msg']);
            $date =  new \DateTime();
            $message->setDate($date);
            $em->persist($message);
            $em->flush();
        }
        return $this->redirectToRoute('salon_chat', ['idSalon'=>$idSalon,'id'=>$session->get('id'),'membre'=>$membre]);

    }  
    /**
     * @Route("/noteUser", name="user_note")
    */
    public function noteUserAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        
        
        $noteuser = new Noteuser();
        if(isset($_GET['id_membre_noter'])){
            $verifNot = $em->getRepository('AppBundle:Noteuser')->findOneBy(
                array("id_membre"=>$session->get('id'), "id_membre_noter"=>$_GET['id_membre_noter'])
                );
            if($verifNot ==null){
                $noteuser->setId_membre($session->get('id'));
                $noteuser->setId_membre_noter($_GET['id_membre_noter']);
                $em->persist($noteuser);
                $em->flush();
            }
        }
        if(isset($_GET['idSalon'])){
            $idSalon = $_GET['idSalon'];
        }else{
            $idSalon =null;
        }
        return $this->redirectToRoute('salon_chat', ['idSalon'=>$idSalon,'id'=>$session->get('id'),'membre'=>$membre]);

    }  
    /**
     * @Route("/banUser", name="user_ban")
    */
    public function banUserAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        if(isset($_GET['id_membre_banni']) && isset($_GET['idSalon'])){
            $participant = $em->getRepository('AppBundle:Participant')->findOneBy(
                    array('id_salon'=>$_GET['idSalon'], 'id_membre'=>$_GET['id_membre_banni'])
                    );
            $moderateur = $em->getRepository('AppBundle:Moderateur')->findOneBy(
                    array('moderateur'=>$_GET['idSalon'], 'id_membre'=>$session->get('id'))
                    );
            if($participant != null){
                if($participant->getBan() ==NULL && $membre->getStatut()!=1){
                    $participant->setBan(1);
                    $em->persist($participant);
                    $em->flush();
                }elseif($participant->getBan() !=NULL && $participant->getBan()<5 && $membre->getStatut()!=1){
                    $participant->setBan($participant->getBan()+1);
                    $em->persist($participant);
                    $em->flush();
                }elseif($participant->getBan() == 5 || $participant->getBan()+1 ==5 || $membre->getStatut()==1 || $moderateur != null){
                    $em->remove($participant);
                    $em->flush();
                    //return $this->redirectToRoute('salon_salons', ['id'=>$session->get('id'),'membre'=>$membre]);
                }
                
            }
            
        }
        if(isset($_GET['idSalon'])){
            $idSalon = $_GET['idSalon'];
        }else{
            $idSalon = null;
        }
        
        return $this->redirectToRoute('salon_chat', ['idSalon'=>$idSalon,'id'=>$session->get('id'),'membre'=>$membre]);

    }  
    /**
     * @Route("/messageReceive/{id}", name="message_chat")
    */
    public function messageReceiveAction(Request $request, $id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($session->get('id')){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
            $messages = $em->getRepository('AppBundle:Chatsalon')->findBy(array('id_salon' => $id),array('date' => 'ASC'));
            $membres = $em->getRepository('AppBundle:Membre')->findAll();
            $messageRecu = array();
            foreach($messages as $message){
                foreach($membres as $m){
                    if($m->getId() == $message->getIdMembre()){
                        $messageRecu[] = array("user"=>$m->getPrenom()." ".$m->getNom(), "message"=>$message->getMsg(), "date"=>$message->getDate()->format('H:m - d/m/Y'),"role"=>$m->getStatut());
                    }
               // );
                }
            }
           return  new JsonResponse($messageRecu);
        }else{
            return  new JsonResponse([]);
           //return $this->redirectToRoute('salon_chat', ['idSalon'=>$id,'id'=>$session->get('id'),'membre'=>$membre]);
        }
    } 
    /**
     * @Route("/moderateur", name="add_moderateur")
    */
    public function moderateurAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        if($membre->getStatut() != null && $membre->getStatut()==1){
            if(isset($_GET['id_membre_moderateur']) && isset($_GET['idSalon'])){
                //moderateur = idsalon
                //idmembre c'est l'utilisateur moderateur de salon
                $moderateur = $em->getRepository('AppBundle:Moderateur')->findOneBy(
                        array('id_membre'=>$_GET['id_membre_moderateur'], 'moderateur'=>$_GET['idSalon'])
                        );
                if($moderateur != null){
                        $em->remove($moderateur);
                        $em->flush();
                }else{
                        $moderateurAdd = new Moderateur();
                        $moderateurAdd->setIdMembre($_GET['id_membre_moderateur']);
                        $moderateurAdd->setModerateur($_GET['idSalon']);
                        $em->persist($moderateurAdd);
                        $em->flush();
                    }
                }
            if(isset($_GET['idSalon'])){
                $idSalon = $_GET['idSalon'];
            }else{
                $idSalon = null;
            }

            return $this->redirectToRoute('salon_chat', ['idSalon'=>$idSalon,'id'=>$session->get('id'),'membre'=>$membre,"id_membre"=>$session->get('id')]);
        }else{
            $membre= new Membre();
            return $this->render('default/303.html.twig',[
                'membre' => $membre,
                "id_membre"=>$session->get('id')
            ]);
        }
    }  
    
 }
    

