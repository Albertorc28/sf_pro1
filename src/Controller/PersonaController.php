<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Persona;
use App\Form\PersonaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
     * @Route("/persona")
     */
class PersonaController extends Controller
{


    public function listado(Request $request)
    {
        $repo=$this->getDoctrine()->getRepository(Persona::class);
        $personas=$repo->findAll();
        return $this->render('persona/index.html.twig',['listapersonas'=>$personas]);
    }
    
    /**
     * @Route("/nuevo", name="persona_nuevo")
     */
    public function index(Request $request)
    {

        $repo= $this->getDoctrine()->getRepository(Persona::class);
        $vectorpersonas=$repo->findAll();

    	$persona=new persona();
    	$formu=$this->createForm(PersonaType::class,$persona);
    	$formu->handleRequest($request);

    	if ($formu->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($persona);

            $entityManager->flush();


			return $this->redirectToRoute('persona_lista', array('id' => $persona->getId()));    		
    	}
        
        return $this->render('persona/index.html.twig', [
            'vectorpersonas'=>$vectorpersonas,
            'formulario'=>$formu->createView(), 
            
        ]);
    }
}
