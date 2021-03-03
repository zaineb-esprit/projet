<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Maisonhote;
use App\Repository\MaisonhoteRepository;
use App\Form\MaisonhoteType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MaisonhoteController extends AbstractController
{
    /**
     * @Route("/maisonhote", name="maisonhote")
     */
    public function index(): Response
    {
        return $this->render('maisonhote/index.html.twig', [
            'controller_name' => 'MaisonhoteController',
        ]);
    }
    /**
     * @Route("/listmaisonhote", name="listmaisonhote")
     */
    public function list()
    {
    	$repository = $this->getdoctrine()->getRepository(maisonhote::class);
    	$maisonhotes= $repository->findAll();
    	 return $this->render('maisonhote/list.html.twig', [
            'maisonhotes' => $maisonhotes,
        ]);

    }
    /**
     * @Route("/newmaisonhote", name="newmaisonhote")
     */
    public function newmaisonhote(Request $request)
    {
    	$maisonhote = new maisonhote();
    	$form = $this->createForm(maisonhoteType::class, $maisonhote);
    	$form->add('Ajouter', SubmitType::class);
    	$form->handleRequest($request);
    	if ($form->isSubmitted()) {
    		$maisonhote = $form->getData();
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($maisonhote);
    	$em->flush();
    	return $this->redirectToRoute('listmaisonhote');
   }
        return $this->render('maisonhote/newmaisonhote.html.twig', [
            'form' => $form->createview (),
        ]);
    }

    /**
     * @Route("/updateMaisonhote/{id}", name="updateMaisonhote")
     */
    public function updateMaisonhote(Request $request, $id )
    {   $em= $this->getDoctrine()->getManager();
        $maisonhote= $em ->getRepository (Maisonhote::class)->find ($id);
        $form =$this->createForm (MaisonhoteType::class, $maisonhote);
        $form -> add ('Modifier', SubmitType::Class);
        $form ->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid ()){
        $em->flush();
        return $this->redirectToRoute('listmaisonhote');
        }
            return $this->render('maisonhote/newMaisonhote.html.twig', [
            'form_title'=> "modifier une maison",
            'form' => $form -> createView (),
        ]);
   }
       /**
     * @Route("/deleteMaisonhote/{id}", name="deleteMaisonhote")
     */
    public function deleteMaisonhote($id )
    {   $em= $this->getDoctrine()->getManager();
        $maisonhote= $em ->getRepository (Maisonhote::class)->find ($id);
        $em-> remove ($maisonhote);
        $em->flush();
        return $this->redirectToRoute('listmaisonhote');
        
    }


}
