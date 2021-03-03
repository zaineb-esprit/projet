<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Resmaison;
use App\Repository\ResmaisonRepository;
use App\Form\ResmaisonType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResmaisonController extends AbstractController
{
    /**
     * @Route("/resmaison", name="resmaison")
     */
    public function index(): Response
    {
        return $this->render('resmaison/index.html.twig', [
            'controller_name' => 'ResmaisonController',
        ]);
    }
/**
     * @Route("/listresmaison", name="listresmaison")
     */
    public function list()
    {
    	$repository = $this->getdoctrine()->getRepository(resmaison::class);
    	$resmaisons= $repository->findAll();
    	 return $this->render('resmaison/list.html.twig', [
            'resmaisons' => $resmaisons,
        ]);

    }
    /**
     * @Route("/newresmaison", name="newresmaison")
     */
    public function newresmaison(Request $request)
    {
    	$resmaison = new resmaison();
    	$form = $this->createForm(resmaisonType::class, $resmaison);
    	$form->add('Ajouter', SubmitType::class);
    	$form->handleRequest($request);
    	if ($form->isSubmitted()) {
    		$resmaison = $form->getData();
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($resmaison);
    	$em->flush();
    	return $this->redirectToRoute('listresmaison');
   }
        return $this->render('resmaison/newresmaison.html.twig', [
            'form' => $form->createview (),
        ]);
    }

    /**
     * @Route("/updateResmaison/{id}", name="updateResmaison")
     */
    public function updateResmaison(Request $request, $id )
    {   $em= $this->getDoctrine()->getManager();
        $resmaison= $em ->getRepository (Resmaison::class)->find ($id);
        $form =$this->createForm (ResmaisonType::class, $resmaison);
        $form -> add ('Modifier', SubmitType::Class);
        $form ->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid ()){
        $em->flush();
        return $this->redirectToRoute('listresmaison');
        }
            return $this->render('resmaison/newResmaison.html.twig', [
            'form_title'=> "modifier une maison",
            'form' => $form -> createView (),
        ]);
   }
       /**
     * @Route("/deleteResmaison/{id}", name="deleteResmaison")
     */
    public function deleteResmaison($id )
    {   $em= $this->getDoctrine()->getManager();
        $resmaison= $em ->getRepository (Resmaison::class)->find ($id);
        $em-> remove ($resmaison);
        $em->flush();
        return $this->redirectToRoute('listresmaison');
        
    }




}
