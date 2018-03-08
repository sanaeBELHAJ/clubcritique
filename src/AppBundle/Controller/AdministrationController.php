<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Concept;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
class AdministrationController extends Controller
{
    /** 
     * @Route("/administration", name="administration_siteadmin")
     */
    public function siteadminAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));
        $membres = $em->getRepository('AppBundle:Membre')->findAll();
        $concept = $em->getRepository('AppBundle:Concept')->find(1);

        if ($membre->getStatut() != 1){
            return $this->redirect(
                sprintf('%s', $this->generateUrl("homepage"))
            );
        }
        if(isset($_POST['concept'])){
            if($concept->getId() == null ){
                $concept = new Concept();
                $concept->setId(1);
            }
            $concept->setConcept($_POST['concept']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($concept);
            $em->flush();
            $this->addFlash('success', "Concept modifié");
        }
        return $this->render('administration\administration.html.twig', [
            'id_membre' => $session->get('id'),
            'membre'=>$membre,
            'concept'=>$concept->getConcept(),
            'membres'=>$membres,
        ]);
    }
    /** 
     * @Route("/delete/{id}", name="administration_deleteuser")
     */
    public function deleteuserAction(Request $request,$id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($id);
        $membre1 = $em->getRepository('AppBundle:Participant')->findBy(array("id_membre"=>$id));
        if($membre!= null && $membre->getId() != $session->get('id')){
            $em = $this->getDoctrine()->getManager();
            $em->remove($membre);
            $em->flush();
            $this->addFlash('success', "l'utilisateur a bien été supprimé");
        }
        return $this->redirectToRoute('administration_siteadmin', []);

    }
   
}
