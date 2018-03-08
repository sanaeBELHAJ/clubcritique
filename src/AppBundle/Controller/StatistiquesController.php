<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Membre;
use AppBundle\Entity\Visitecategorie;
use AppBundle\Entity\Concept;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Article;

use Symfony\Component\Validator\Constraints\Date;


class StatistiquesController extends Controller
{
    /**
     * @Route("/statistique", name="statistiques_statistique")
     */
    public function statistiqueAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('AppBundle:Membre')->find($session->get('id'));

        return $this->render('administration\statistiques.html.twig', [
            'id_membre' => $session->get('id'),
            'membre' => $membre,
        ]);
    }

    /**
     * @Route("/visiteCategorie", name="statistiques_visiteCategorie")
     */
    public function visiteCategorieAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $visiteCategories = $em->getRepository('AppBundle:Visitecategorie')->findAll();
        $visites = array();
        foreach ($visiteCategories as $visiteCategorie) {
            $Categories = (new Categories())->getById($em, $visiteCategorie->getId_categorie());
            if (!is_object(!$Categories)) {

                $visites[] = array(
                    $Categories->name,
                    $visiteCategorie->getNb_visite(),
                );
            }
        }

        return new JsonResponse($visites);


    }

    /**
     * @Route("/articleStat", name="statistiques_articleStat")
     */
    public function ArticleByCategoryAction(Request $request)
    {
        $session = $request->getSession();

        $em = $this->get('doctrine')->getManager();
        $categories = (new Categories())->getAll($em);
        $array = array();
        foreach ((new Categories())->getAll($em) as $categorie) {
            $array[] = [
                $categorie->name,
                count($categorie->getProducts($em)),
            ];
        }


        return new JsonResponse($array);

    }

//    /**
//     * @Route("/echangeStat", name="statistiques_echangeStat")
//     */
//    public function echangeStatAction(Request $request)
//    {
//        $session = $request->getSession();
//
//        $em = $this->get('doctrine')->getManager();
//        $status_own = count($em->getRepository('EntityBundle:Borrow')->findBy(["status" => 7]));
//        $status_share = count($em->getRepository('EntityBundle:Borrow')->findBy(["status" => 1]));
//        $status_interest = count($em->getRepository('EntityBundle:Borrow')->findBy(["status" => 2]));
//        $status_valid = count($em->getRepository('EntityBundle:Borrow')->findBy(["status" => 3]));
//
//
//        $array[] = array("Proprietaire de livre", $status_own + $status_share + $status_interest + $status_valid);
//        $array[] = array("Livre à preter", $status_share + $status_interest + $status_valid);
//        $array[] = array("livre prêté", $status_interest + $status_valid);
//
//        //return $array;
//
//
//        return new JsonResponse($array);
//
//    }

    /**
     * @Route("/nbVisite", name="statistiques_nbVisite")
     */
    public function nbVisiteAction(Request $request)
    {
        $session = $request->getSession();

        $em = $this->get('doctrine')->getManager();
        $visites = $em->getRepository('AppBundle:Visiteur')->findAll();
        $visiteur = array();
        foreach ($visites as $visite) {
            $datev = $visite->getDate_visite();
            if (isset($visiteur[$datev->format('Y-m-d')])) {
                $visiteur[$datev->format('Y-m-d')] = $visiteur[$datev->format('Y-m-d')] + $visite->getNb_visite();
            } else {
                $visiteur[$datev->format('Y-m-d')] = $visite->getNb_visite() + 1;
            }
        }
        $nbVisite = array();
        foreach ($visiteur as $key => $value) {
            $nbVisite[] = array(
                $key, "$value"
            );

        }
        // var_dump($visiteur);
        //echo json_encode($visiteur);

        return new JsonResponse($nbVisite);
        //return $this->redirectToRoute('statistiques_statistique', []);
    }

    /**
     * @Route("/attributsPerCat", name="statistiques_attributsPerCat")
     */
//    public function attributsPerCatAction(Request $request)
//    {
//
//        $em = $this->get('doctrine')->getManager();
//
//        $categories = (new Categories())->getAll($em);
//
//        $array = [];
//        $count = array(0, 0, 0, 0, 0);
//
//        foreach ($categories as $category) {
//            $count = array(0, 0, 0, 0, 0);
//            foreach ($category->attributes as $attribute) {
//                if ($attribute->type == 'text') {
//                    $count[0]++;
//                }
//                if ($attribute->type == 'select') {
//                    $count[1]++;
//                }
//                if ($attribute->type == 'date') {
//                    $count[2]++;
//                }
//                if ($attribute->type == 'integer') {
//                    $count[3]++;
//                }
//                if ($attribute->type == 'image') {
//                    $count[4]++;
//                }
//            }
//
//            $array[] = array(
//                "name" => $category->name,
//                "data" => $count,
//
//            );
//        }
//        return new JsonResponse($array);
//
//    }
//
//    /**
//     * @Route("/completed", name="statistiques_completed")
//     */
//    public function completedProductsAction(Request $request)
//    {
//
//        $em = $this->get('doctrine')->getManager();
//        $categories = (new Categories())->getAll($em);
//
//
//        foreach ($categories as $category) {
//            $products = (new Product())->getByCategory($em,$category->id);
//            $array = array(0,0);
//            foreach ($products as $product) {
//                if (!$product->getValueByName("titre") ||
//                    !$product->getValueByName("front") ||
//                    !$product->getValueByName("image") ||
//                    !$product->getValueByName("description")
//                ) {
//                    $array[0] += 1;
//                } else {
//                    $array[1] += 1;
//
//                }
//            }
//            $return[] = array(
//                "name" => 0,
//                "color" => "rgba(165, 170, 217, 1)",
//                "data" => $array,
//                "pointPadding" => 0.3,
//                "pointPlacement" => -0.2
//            );
//        }
//
//        return new JsonResponse($return);
//
//    }


}
