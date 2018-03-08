<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Messagerie;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Salon;
use AppBundle\Entity\Article;
use AppBundle\Form\MailForm;
use AppBundle\Form\ContactForm;

class MessagerieController extends Controller
{
    /** 
     * @Route("/", name="membre_index")
     */
    public function indexAction()
    {
        
        
    }
    /** 
     * @Route("/reception", name="messagerie_reception")
     */
    public function receptionAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository('AppBundle:Membre')->findAll();
        
        $message = new Messagerie();
        $form = $this->createForm(mailForm::class, $message,
                array(
                     'action' => $this->generateUrl('messagerie_sendMessageAdmin'),
                     'method' => 'POST',
                ));
        $form->handleRequest($request);
        
        $SenderIds = array();
        foreach ($membres as $m){
            $SenderIds[] = $m->getId();
        }
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $messagerieReceve = $em->getRepository('AppBundle:Messagerie')->findBy(array('id_recever' => $session->get('id')),array('date' => 'desc'));
        $messagerieSent = $em->getRepository('AppBundle:Messagerie')->findBy(array('id_sender' => $session->get('id')),array('date' => 'desc'));
        return $this->render('mail\boiteReception.html.twig', [
            'messagerieSent'=>$messagerieSent,
            'messagerie'=>$messagerieReceve,
            'membres' => $membres,
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'SenderIds'=>$SenderIds,
            'form' => $form->createView()
               
            
        ]);
        
    }
    /** 
     * @Route("/lire/{id}", name="messagerie_lire")
     */
    public function lireAction($id, Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository('AppBundle:Messagerie')->findOneById($id);
        if($session->get('id')==$message->getId_recever()){
           $message->setVu(1);
           $em->persist($message);
           $em->flush();
           $this->addFlash('success', "Lu");
        }
        $membres = $em->getRepository('AppBundle:Membre')->findAll();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $SenderIds = array();
        foreach ($membres as $m){
            $SenderIds[] = $m->getId();
        }
        return $this->render('mail\lireMail.html.twig', [
            'message'=>$message,
            'membres' => $membres,
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'SenderIds' => $SenderIds
        ]);
        
    }
    /** 
     * @Route("/nousContacter", name="messagerie_nouscontacter")
     */
    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $receverAdmin = $em->getRepository('AppBundle:Membre')->findBy(array('statut'=>1));
        //var_dump($receverAdmin);
        $message = new Messagerie();
        $form = $this->createForm(contactForm::class, $message);
        $form->handleRequest($request);
        
        if($form->isValid()){
            // query for a single product matching the given name and price
            $membre = new Membre();
            if(!$em->getRepository('AppBundle:Membre')->findBy(array('mail'=>$request->get('mail')))){
                $membre->setNom($request->get('nom'));
                $membre->setMail($request->get('mail'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($membre);
                $em->flush();
                $message->setId_Sender($membre->getId());
            }else{
                $sender = $em->getRepository('AppBundle:Membre')->findOneBy(array('mail'=>$request->get('mail')));
                $message->setId_Sender($sender->getId());
            }
            
            foreach ($receverAdmin as $admin){
                $message->setId_Recever($admin->getId());
                $message->setVu(0);
                //$message->setDate(Symfony\Component\Validator\Constraints\Date('Y-m-d H:i'));
                $date = new \DateTime(date('Y-m-d H:i:s'));
              //  var_dump($date);
                //$date =$date->format('Y-m-d H:i');
                $message->setDate($date);
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();
            }
        }
       // var_dump($message.getId());
        //die;
        $membres = $em->getRepository('AppBundle:Membre')->findAll();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        return $this->render('mail/nousContacter.html.twig', [
            'form'=>$form->createView(),
            'id_membre' => $session->get('id'),
            'membre' => $membre,
        ]);
        
    }


    /**
     * @Route("/send/{id}", name="messagerie_send")
    */
    public function sendAction(Request $request, $id)
    {
        $message = new Messagerie();
        $form = $this->createForm(mailForm::class, $message);
        $form->handleRequest($request);
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $membreRecever = $em->getRepository('AppBundle:Membre')->find($id);
        if($form->isValid()){
            // query for a single product matching the given name and price
            $message->setId_Sender($session->get('id'));
            $message->setId_Recever($id);
            $message->setVu(0);
            //$message->setDate(Symfony\Component\Validator\Constraints\Date('Y-m-d H:i'));
            $date = new \DateTime(date('Y-m-d H:i:s'));
          //  var_dump($date);
            //$date =$date->format('Y-m-d H:i');
            $message->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messagerie_reception', ['id'=>$session->get('id'),'membre'=>$membre]);


        }
        return $this->render('mail/mail.html.twig',[
            'membre' => $membre,
            'form' => $form->createView(),
            'id_membre' => $session->get('id'),
            'membreRecever' => $membreRecever,
        ]);
    }
     /**
     * @Route("/sendMessageAdmin", name="messagerie_sendMessageAdmin")
    */
    public function sendMessageAdminAction(Request $request)
    {
        $message = new Messagerie();
       
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $membreRecevers = $em->getRepository('AppBundle:Membre')->findAll();
        var_dump($membreRecevers);
       // die;
        $data = $request->get('mail_form');
        if($request->isMethod('POST')){
            if(isset($data['objet']) && isset($data['message'])){
                foreach($membreRecevers as $membreRecever){
                        $message->setId_Sender($session->get('id'));
                        $message->setId_Recever($membreRecever->getId());
                        $message->setObjet($data['objet']);
                        $message->setMessage($data['message']);
                        $message->setVu(0);
                        $date = new \DateTime(date('Y-m-d H:i:s'));
                        $message->setDate($date);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($message);
                        $em->flush();
                }
            }
              
        }
       return $this->redirectToRoute('messagerie_reception', ['id'=>$session->get('id'),'membre'=>$membre]);      

    }
    /**
     * @Route("/inviteSalon/{idSalon}/{id}", name="invite_salon")
    */
    public function invitationSalonAction(Request $request, $id, $idSalon)
    {
        $message = new Messagerie();
        $session = $request->getSession();
        if($session->get('id')){
            $em = $this->getDoctrine()->getManager();
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
            $membreRecever = $em->getRepository('AppBundle:Membre')->find($id);
            $salon   = $em->getRepository('AppBundle:Salon')->find($idSalon);
            $article = $em->getRepository('AppBundle:Article')->find($salon->getIdArticle());
            // query for a single product matching the given name and price
            $message->setId_Sender($session->get('id'));
            $message->setId_Recever($id);
            $message->setObjet("Invitation au salon ".$salon->getTitreSalon()."");
            $message->setMessage(
                     "Bonjour,"
                    . "Je t'invite à rejoindre le salon ".$salon->getTitreSalon()." à propos de ". $article->getTitre().""
                    );
            $message->setVu(0);
            $date = new \DateTime(date('Y-m-d H:i:s'));
            $message->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->redirectToRoute('salon_chat', ['idSalon'=>$idSalon,'id'=>$session->get('id'),'membre'=>$membre]);

        }else{
            return $this->redirectToRoute('homepage');      
        }
    }
}
