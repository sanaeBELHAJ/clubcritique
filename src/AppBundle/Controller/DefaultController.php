<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Salon;
use AppBundle\Entity\Messagerie;
use AppBundle\Form\MembreForm;
use AppBundle\Form\ConnexionForm;
use AppBundle\Form\ContactForm;
use AppBundle\Form\InscriptionForm;
use AppBundle\Helper\Helper;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
	$query = $em->createQuery(
		        "SELECT s
			FROM AppBundle:Salon s
			WHERE s.date_debut >= :date"
	   )->setParameter('date', new \DateTime());
        
	$NextSalon = $query->getResult();
        if($NextSalon){
            $NextSalon = $query->getSingleResult();
        }
        $articles = $em->getRepository('AppBundle:Article')->findBy(array('laune'=>1));


        $membre = new Membre();
        $form = $this->createForm(InscriptionForm::class, $membre);
        $form->handleRequest($request);
        $session = $request->getSession();

        $erreur=null;
        if($form->isValid()){
            $repository = $this->getDoctrine()->getRepository('AppBundle:Membre');
            // query for a single product matching the given name and price
            $mailMembre= $repository->findOneBy(
                array('mail' => $membre->getMail())
            );
            if(filter_var($membre->getMail(), FILTER_VALIDATE_EMAIL) && $mailMembre == null){
                $mdp = Helper::createPassword(10);//.''.base64_encode($membre->getMail());
                $hashed_password = 'RTBDSG907HGVB@@BGJGfgcgfVGHCDFVBHJhfhg0989';
                $membre->setMdp(crypt($mdp,$hashed_password));
                $membre->setNom('Utilisateur');
                $membre->setPrenom('Utilisateur');
                $message = \Swift_Message::newInstance()
                 ->setSubject('Confirmation d\'inscription sur le club des critiques')
                 ->setFrom('noreply@clubcritique.com')
                 ->setTo($membre->getMail())
                 ->setBody('Bonjour ! ici est votre lien de confirmation!'
                         . '<br> Votre login: '.$membre->getMail().''
                         . '<br> Votre Mot de passe : '.$mdp .'',
                 'text/html'
                 );
                $this->get('mailer')->send($message);
                $em->persist($membre);
                $em->flush();
                $erreur=null;
                $this->addFlash('success', "Mail de configuration a été envoyé");
            }elseif(!filter_var($membre->getMail(), FILTER_VALIDATE_EMAIL)){
                $erreur ="Veuillez renseigner une adresse mail valide!";
            }else{
                $erreur ="L'adresse mail existe déja!";
            }
           //return $this->redirectToRoute('membre_show', ['id'=>$membre->getId()]);      
        }
        if($session->get('id')!=null){
            $em = $this->getDoctrine()->getManager();
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        }
        $em = $this->getDoctrine()->getManager();
        $concept = $em->getRepository('AppBundle:Concept')->find(1);
        
        //nous contactez 
        
        $receverAdmin = $em->getRepository('AppBundle:Membre')->findBy(array('statut'=>1));
        //var_dump($receverAdmin);
        $message = new Messagerie();
        $contactForm = $this->createForm(contactForm::class, $message);
        $contactForm->handleRequest($request);
        
        if($contactForm->isValid()){
            // query for a single product matching the given name and price
            $membreSender = new Membre();
            if(!$em->getRepository('AppBundle:Membre')->findBy(array('mail'=>$request->get('mail')))){
                $membreSender->setNom($request->get('nom'));
                $membreSender->setMail($request->get('mail'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($membreSender);
                $em->flush();
                $message->setId_Sender($membreSender->getId());
            }else{
                $sender = $em->getRepository('AppBundle:Membre')->findOneBy(array('mail'=>$request->get('mail')));
                $message->setId_Sender($sender->getId());
            }
            
            foreach ($receverAdmin as $admin){
                $message->setId_Recever($admin->getId());
                $message->setVu(0);
                $date = new \DateTime(date('Y-m-d H:i:s'));
                $message->setDate($date);
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();
            }
        }
        return $this->render('home/index.html.twig',[
            'membre' => $membre,
            'email' => $form->createView(),
            'id_membre' => $session->get('id'),
            'concept' => $concept->getConcept(),
            'mailExist'=>$erreur,
            'form'=>$contactForm->createView(),
            'nextSalon' => $NextSalon,
            'articles'=>$articles,
        ]);
    }
    /**
     * @Route("/contenu", name="contenu")
     */
    public function contenuAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $categories = (new Categories())->getAll($em);
        $categorie_products = array();
        foreach    ($categories as $category) {
            $categorie_products[$category->id] = $category->getProducts($em);
        }

        if($session->get('id')!=null){
            $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        }else{
            $membre = new Membre();
        }
        return $this->render('contenu/contenu.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'categories' => $categories,
            'categorie_products' => $categorie_products,

        ]);
    }
   
}
