<?php

namespace project\GameHubBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use project\GameHubBundle\Entity\Admin;
use project\GameHubBundle\Entity\Jeux;
use project\GameHubBundle\Entity\Rating;
use project\GameHubBundle\Form\JeuxType;
use project\GameHubBundle\Form\RatingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class JeuxController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $jeu=new Jeux();
        $Form = $this->createForm(JeuxType::class, $jeu);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $em=$this->getDoctrine()->getManager();


            /** @var UploadedFile $affiche */
            $affiche=$jeu->getAffiche();
            $afficheName= md5(uniqid()).'.'.$affiche->guessExtension();
            $affiche->move(
                $this->getParameter('affiches_directory'),
                $afficheName
            );
            $jeu->setAffiche($afficheName);
            $em->persist($jeu);
            $em->flush();
            return $this->redirectToRoute("afficherJeu");
        }
        return $this->render('projectGameHubBundle:Jeux:ajouter.html.twig',array(
            'form' =>$Form->createView()
        ));
    }

    public function listAction(Request $request)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $jeux=$em->getRepository("projectGameHubBundle:Jeux")->findAll();

        return $this->render('projectGameHubBundle:Jeux:affichage.html.twig',array('jeux'=>$jeux));
    }

    public function modifierAction(Request $request,$id)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("projectGameHubBundle:Jeux")->find($id);

        $jeu->setAffiche(null);


        $Form = $this->createForm(JeuxType::class, $jeu);


        $Form->handleRequest($request);



        if($Form->isValid()){

            $em=$this->getDoctrine()->getManager();
            /** @var UploadedFile $affiche */
            $affiche=$jeu->getAffiche();
            $afficheName= md5(uniqid()).'.'.$affiche->guessExtension();
            $affiche->move(
                $this->getParameter('affiches_directory'),
                $afficheName
            );
            $jeu->setAffiche($afficheName);

            $em->persist($jeu);
            $em->flush();
            return $this->redirectToRoute("afficherJeu");
        }
        return $this->render('projectGameHubBundle:Jeux:modifier.html.twig',array(
            'form' =>$Form->createView(),'jeu'=>$jeu
        ));
    }
    public function supprimerAction($id)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("projectGameHubBundle:Jeux")->find($id);

        $em->remove($jeu);
        $em->flush();



        return $this->redirectToRoute("afficherJeu");
    }

    public function listFoAction(Request $request)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();

        $paginator =  $this->get('knp_paginator');
        $nbr=null;

        if($request->isMethod('GET')&&(($request->get('rech_titre'))!=null)&&(($request->get('genre'))!=null)&&(($request->get('rech_titre'))!="")&&(($request->get('genre'))!="rien")){


            $jeux=$em->getRepository("projectGameHubBundle:Jeux")->searchTitreGenreDQL($request->get('rech_titre'),$request->get('genre'));

            $nbr=count($jeux);


            $pagination = $paginator->paginate(
                $jeux
                ,$request->query->getInt('page', 1)
                ,2
            );

            return $this->render('projectGameHubBundle:JeuxFO:ListJeux.html.twig',array('jeux'=>$pagination,'nbr'=>$nbr));




        }

        if($request->isMethod('GET')&&(($request->get('rech_titre'))!=null)&&(($request->get('rech_titre'))!="")){


            $jeux=$em->getRepository("projectGameHubBundle:Jeux")->searchTitreDQL($request->get('rech_titre'));

            $nbr=count($jeux);


            $pagination = $paginator->paginate(
                $jeux
                ,$request->query->getInt('page', 1)
                ,2
            );

            return $this->render('projectGameHubBundle:JeuxFO:ListJeux.html.twig',array('jeux'=>$pagination,'nbr'=>$nbr));




        }
        if($request->isMethod('GET')&&(($request->get('genre'))!=null)&&(($request->get('genre'))!="rien")){

            $jeux=$em->getRepository("projectGameHubBundle:Jeux")->findBy(array('genre'=>$request->get('genre')));
            $nbr=count($jeux);
            $pagination = $paginator->paginate(
                $jeux
                ,$request->query->getInt('page', 1)
                ,2
            );

            return $this->render('projectGameHubBundle:JeuxFO:ListJeux.html.twig',array('jeux'=>$pagination,'nbr'=>$nbr));




        }


        $jeux=$em->getRepository("projectGameHubBundle:Jeux")->findAll();

        $pagination = $paginator->paginate(
          $jeux
            ,$request->query->getInt('page', 1)
            ,2
        );


        return $this->render('projectGameHubBundle:JeuxFO:ListJeux.html.twig',array('jeux'=>$pagination,'nbr'=>$nbr));
    }

    public function detailFoAction($id)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("projectGameHubBundle:Jeux")->find($id);


        return $this->render('projectGameHubBundle:JeuxFO:JeuDetail.html.twig',array('jeu'=>$jeu));
    }
    public function trailerFoAction($id)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("projectGameHubBundle:Jeux")->find($id);


        return $this->render('projectGameHubBundle:JeuxFO:JeuDetailTrailer.html.twig',array('jeu'=>$jeu));
    }





}
