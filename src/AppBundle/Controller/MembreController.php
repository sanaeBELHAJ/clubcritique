<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Articleproprietaire;
use AppBundle\Entity\Article;
use AppBundle\Entity\Amis;
use AppBundle\Entity\Visiteur;
use AppBundle\Form\MembreForm;
use AppBundle\Form\ConnexionForm;
use AppBundle\Form\EditPwdForm;
class MembreController extends Controller
{
    /**
     * @Route("/Administration", name="membre_admin")
     */
    public function adminAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $concept = $em->getRepository('AppBundle:Concept')->find(1);
        $membres = $em->getRepository('AppBundle:Membre')->findAll();
        return $this->render('administration\administration.html.twig', [
            'id_membre' => $session->get('id'),
            'membre'=>$membre,
            'concept'=>$concept->getConcept(),
            'membres'=>$membres,

        ]);
    }
    /**
     * @Route("/all", name="membre_all")
     */
    public function peopleAction(Request $request)
    {
        $session = $request->getSession();
        if($session->get('id')){
            if(isset($_POST['nom'])){
                $em = $this->getDoctrine()->getManager();
                $membres = $em->getRepository('AppBundle:Membre')->findBy(
                        array("nom"=>$_POST['nom'])
                        );
                $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
                $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
                $membre1 = $repository->findBy(
                        array('id_membre1' =>$session->get('id'))
                    );
                $membre2 = $repository->findBy(
                        array('id_membre2' =>$session->get('id'))
                    );
                $listAmis = array();
                if(isset($membre1)){
                    foreach ($membre1 as $amis){
                         $listAmis[] = $amis->getId_Membre2();
                    }
                }
                if(isset($membre2)){
                    foreach ($membre2 as $amis){
                         $listAmis[] = $amis->getId_Membre1();
                    }
                }
            }else{
                $em = $this->getDoctrine()->getManager();
                $membres = $em->getRepository('AppBundle:Membre')->findAll();
                $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
                $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
                $membre1 = $repository->findBy(
                        array('id_membre1' =>$session->get('id'))
                    );
                $membre2 = $repository->findBy(
                        array('id_membre2' =>$session->get('id'))
                    );
                $listAmis = array();
                if(isset($membre1)){
                    foreach ($membre1 as $amis){
                         $listAmis[] = $amis->getId_Membre2();
                    }
                }
                if(isset($membre2)){
                    foreach ($membre2 as $amis){
                         $listAmis[] = $amis->getId_Membre1();
                    }
                }
            }
            return $this->render('membre\membres.html.twig', [
                'membres'=>$membres,
                'id_membre' => $session->get('id'),
                'membre'=>$membre,
                'listAmis'=> $listAmis,

            ]);
        }else{
            $membre= new Membre();
            return $this->render('default/303.html.twig',[
                'membre' => $membre,
                "id_membre"=>$session->get('id')
            ]);
        }
    }
    /**
     * @Route("/profil/{id}", name="membre_profil")
     */
    public function profilAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $membre = $em->getRepository('AppBundle:Membre')->findOneById($id);
        $editPwdForm = $this->createForm(EditPwdForm::class, $membre,
                array(
                     'action' => $this->generateUrl('membre_edit_pwd'),
                     'method' => 'POST',
                ));
        $editInfoForm = $this->createForm(MembreForm::class, $membre,
                array(
                     'action' => $this->generateUrl('membre_editinfo'),
                     'method' => 'POST',
                ));
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        // query for a single product matching the given name and price
        $membre1 = $repository->findBy(
                array('id_membre1' =>$session->get('id'),'accepter'=>1)
            );
           // var_dump($membre1);
        $amisId = array();
        foreach($membre1 as $m1){
            $amisId[] = $m1->getId_membre2();
        }
        $membre2 = $repository->findBy(
                array('id_membre2' =>$session->get('id'),'accepter'=>1)
            );
       // var_dump($membre2);
        foreach($membre2 as $m2){
            $amisId[] = $m2->getId_membre1();
        }
        $membres_amis = array();
        foreach ($amisId as $id){
            $membres_amis[] =  $em->getRepository('AppBundle:Membre')->find($id);
        }
        
        $mesArticle = $em->getRepository('AppBundle:Articleproprietaire')->findBy(array('id_membre' =>$session->get('id')));
        $idAcrticles = array();
        if($mesArticle!=null){
            foreach($mesArticle as $idArticle){
                $idAcrticles[] = $idArticle->getId_article();
            }
        }
        $mesarticles = array();
        if(isset($idAcrticles) && $idAcrticles!=null){
            foreach($idAcrticles as $idArticle){
                $mesarticles[] = $em->getRepository('AppBundle:Article')->find($idArticle);
            }
        }
      

        return $this->render('membre\profil.html.twig', [
            'membre'=>$membre,
            'amis'=>$membres_amis,
            'picture'=>$membre->getPicture(),
            'mesarticles'=>$mesarticles,
            'id_membre' => $session->get('id'),
            'editPwdForm'=>$editPwdForm->createView(),
            'editInfoForm'=>$editInfoForm->createView(),
        ]);
    }
    /**
     * @Route("/editinfo", name="membre_editinfo")
     */

    public function editInfoAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));

        $form = $this->createForm(MembreForm::class, $membre);
        $form->handleRequest($request);
        if($form->isValid()){
           $em->persist($membre);
           $em->flush();
           $this->addFlash('success', "Vos informations personnelles sont à jour!");
        }
        return $this->redirectToRoute('membre_profil', ['id'=>$session->get('id')]);

    }
    /**
     * @Route("/editPwd", name="membre_edit_pwd")
     */

    public function editPwdAction(Request $request)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->findOneById($session->get('id'));
        $data = $request->get('edit_pwd_form');
        if($request->isMethod('POST')){
            if(isset($data['mdp']) && isset($data['confirm'])){
               if($data['mdp']==$data['confirm']){
                    $hashed_password = 'RTBDSG907HGVB@@BGJGfgcgfVGHCDFVBHJhfhg0989';
                    $membre->setMdp(crypt($data['mdp'],$hashed_password));
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($membre);
                    $em->flush();
                }else{
                    echo "le mot ne correspond à sa confirmation!";
                }
            }
        }


        return $this->redirectToRoute('membre_profil', ['id'=>$session->get('id'),'membre'=>$membre]);
    }
    /**
     * @Route("/invite/{id}", name="membre_invite")
     */

    public function inviteAction($id, Request $request)
    {
        $session = $request->getSession();
        $membre = new Membre();
        $amis = new Amis();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        $membre1 = $repository->findOneBy(
                array('id_membre1' =>$session->get('id'),'id_membre2' =>$id)
            );
            //var_dump($membre1);
        $membre2 = $repository->findOneBy(
                array('id_membre2' =>$session->get('id'),'id_membre1' =>$id)
            );
            //var_dump($membre2);
        if($membre1 == null && $membre2 == null){
            $amis->setId_membre1($session->get('id'));
            $amis->setId_membre2($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($amis);
            $em->flush();
            $this->addFlash('success', "Invitation envoyée");
        }
        return $this->redirectToRoute('membre_all', ['id'=>$membre->getId(),'id_membre' => $session->get('id'),'membre'=>$membre,]);
    }
    /**
     * @Route("/alerteInvite/{id}", name="membre_alerteInvite")
     */

    public function alerteInviteAction($id, Request $request)
    {
        $session = $request->getSession();
        $membre = new Membre();
        $amis = new Amis();
       // $session->get('id');
        $amis->setId_membre1($session->get('id'));
        $amis->setId_membre2($id);
        $em = $this->getDoctrine()->getManager();
        $em->persist($amis);
        $em->flush();
        $this->addFlash('success', "Invitation envoyée");

        return $this->redirectToRoute('membre_all', ['id'=>$membre->getId(),'id_membre' => $session->get('id'),'membre'=>$membre,]);
    }
    /**
     * @Route("/notificationInvit", name="membre_notificationInvit")
     */

    public function notificationInvitAction(Request $request)
    {
        $session = $request->getSession();
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        $invitations = $repository->findBy(
                array(
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 0,
                    'vu'  => 0
                ));
        return new JsonResponse($invitations);
    }
    /**
     * @Route("/setInvitationToVu", name="membre_setInvitationToVu")
     */

    public function setInvitationToVuAction(Request $request)
    {
        $session = $request->getSession();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        $invitations = $repository->findBy(
                array(
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 0,
                    'vu'  => 0
                ));
        foreach($invitations as $invitation){
            $invitation->setVu(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();
            $this->addFlash('success',"Vu");
        }
        return new JsonResponse([]);
    }

    /**
     * @Route("/invitationList", name="membre_invitationList")
     */

    public function invitationListAction(Request $request)
    {
        $session = $request->getSession();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        // query for a single product matching the given name and price
        $invitations = $repository->findBy(
                array(
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 0
                ));
        $inviters=[];
        foreach($invitations as $invitation){
            $inviters[] = $invitation->getId_membre1();
        }
        $inviter = array();
        if(isset($inviters)){
            foreach($inviters as $inviter_id){
                $repository = $this->getDoctrine()->getRepository('AppBundle:Membre');
                $inviter[] = $repository->find($inviter_id);
            }
        }
        $membre = $this->getDoctrine()->getRepository('AppBundle:Membre')->find($session->get('id'));
        return $this->render('membre/invitationList.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'inviters' => $inviter,
        ]);
    }
    /**
     * @Route("/acceptInvitation/{id}", name="membre_acceptInvitation")
     */

    public function acceptInvitationAction($id, Request $request)
    {
        $session = $request->getSession();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        // query for a single product matching the given name and price
        $invitation = $repository->findOneBy(
                array(
                    'id_membre1'=>$id,
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 0
                ));
        $invitation->setAccepter(1);
       // $membre = $this->getDoctrine()->getRepository('AppBundle:Membre')->find($session->get('id'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($invitation);
        $em->flush();
        $this->addFlash('success', "Vous êtes devenu amis!");
        return $this->redirectToRoute('membre_invitationList', ['id_membre' => $session->get('id')]);

    }
    /**
     * @Route("/supprimerInvitation/{id}", name="membre_supprimerInvitation")
     */

    public function supprimerInvitationAction($id, Request $request)
    {
        $session = $request->getSession();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        // query for a single product matching the given name and price
        $invitation = $repository->findOneBy(
                array(
                    'id_membre1'=>$id,
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 0
                ));
        $em = $this->getDoctrine()->getManager();
        $em->remove($invitation);
        $em->flush();
        $this->addFlash('success', "l'invitation a bien été supprimé");
        return $this->redirectToRoute('membre_invitationList', ['id_membre' => $session->get('id')]);

    }
    /**
     * @Route("/supprimerAmis/{id}", name="membre_supprimerAmis")
     */

    public function supprimerAmisAction($id, Request $request)
    {
        $session = $request->getSession();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Amis');
        // query for a single product matching the given name and price
        $invitation = $repository->findOneBy(
                array(
                    'id_membre1'=>$id,
                    'id_membre2'=>$session->get('id'),
                    'accepter'  => 1
                ));
        if($invitation ==null){
            $invitation = $repository->findOneBy(
                array(
                    'id_membre1'=>$session->get('id'),
                    'id_membre2'=>$id,
                    'accepter'  => 1
                ));
        }
        if($invitation!=null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($invitation);
            $em->flush();
            $this->addFlash('success', "l'invitation a bien été supprimé");
        }
       
        return $this->redirectToRoute('membre_profil', ['id'=>$session->get('id'),'id_membre' => $session->get('id')]);

    }
    /**
     * @Route("/mesAmis", name="membre_mesAmis")
     */

    public function mesAmisAction(Request $request)
    {
        $session = $request->getSession();

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
        foreach($membre2 as $m2){
            $amisId[] = $m2->getId_membre1();
        }
        $em = $this->getDoctrine()->getRepository('AppBundle:Membre');
        // query for a single product matching the given name and price
        $membres = $repository->find($amisId);

        return $this->redirectToRoute('membre_profil', ['id_membre' => $session->get('id')]);
    }
    /**
     * @Route("/editPicture", name="membre_picture")
     */

    public function editpictureAction(Request $request)
    {
        $session = $request->getSession();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Membre');
        // query for a single product matching the given name and price
        $membre = $repository->find($session->get('id'));
        if(isset($_FILES['picture'])){
                $uploaddir = 'ressource/profil/';
                $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
                var_dump($uploadfile);
                echo '<pre>';
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
                        $membre->setPicture($_FILES['picture']['name']);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($membre);
                        $em->flush();
                        $this->addFlash('success', "image telechargée");
                        echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                        echo "la taille de l'image dépasse la taille autorisé.";
                }

            }
        return $this->redirectToRoute('membre_profil', [
            'membre'=>$membre,
            'id_membre' => $session->get('id'),
            'id' => $session->get('id'),
           // 'picture' => $membre->getPicture(),
            ]);
    }
    /**
     * @Route("/login", name="membre_login")
    */
    public function loginAction(Request $request)
    {
        $membre = new Membre();
        $form = $this->createForm(ConnexionForm::class, $membre);
        $form->handleRequest($request);
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($form->isValid()){
            $repository = $this->getDoctrine()->getRepository('AppBundle:Membre');
            // query for a single product matching the given name and price
            $hashed_password = 'RTBDSG907HGVB@@BGJGfgcgfVGHCDFVBHJhfhg0989';
            $membre->setMdp(crypt($membre->getMdp(),$hashed_password));
            $membre = $repository->findOneBy(
                array('mail' => $membre->getMail(), 'mdp' => $membre->getMdp())
            );
            if($membre!=null){
               // var_dump($membre->getDescription());
                /*return $this->redirectToRoute('membre_profil', [
                     'id'=>$membre->getId(),
                ]); */
                $visiteur = new Visiteur();
                $visiteur->setNb_visite(1);
                $visiteur->setId_membre($membre->getId());
                $em = $this->getDoctrine()->getManager();
                $em->persist($visiteur);
                $em->flush();
                $this->addFlash('success', "visite");

                $session->set('id', $membre->getId());
                $session->set('name', $membre->getNom());
                $session->set('statut', $membre->getStatut());
                /*return $this->render('membre\profil.html.twig', [
                    'membre'=>$membre,
                    'picture'=>$membre->getPicture(),
                    'name'=>$session->get('name'),
                    'id_membre' => $session->get('id'),
                ]);*/
                return $this->redirectToRoute('membre_profil', [
                    'membre'=>$membre,
                    'id_membre' => $session->get('id'),
                    'id' => $session->get('id'),
                    'picture' => $membre->getPicture(),
                    ]);
            }

        }

        return $this->render('membre/login.html.twig',[
            'membre' => $membre,
            'id_membre' => $session->get('id'),
            'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/changeRole", name="membre_changeRole")
    */
    public function changeRoleAction(Request $request)
    {
        $session = $request->getSession();
        var_dump($_GET['statut']);
        die;
        if(isset($_GET['statut']) && isset($_GET['id'])){
            $em = $this->getDoctrine()->getManager();
            $membre = $em->getRepository('AppBundle:Membre')->find($_GET['id']);
            $membre->setStatut($_GET['statut']);
            $em->persist($membre);
            $em->flush();

        }
        return $this->redirectToRoute('administration_siteadmin', []);
    }
    /**
     * @Route("/logout", name="membre_logout")
    */
    public function logoutAction(Request $request)
    {
        $session = $request->getSession();
        $session->remove('id');
        return $this->redirectToRoute('homepage', []);
    }
}
