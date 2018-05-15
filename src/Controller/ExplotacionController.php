<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Explotacion;
use App\Form\ExplotacionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* @Route("/explotacion")
*/
class ExplotacionController extends Controller
{
    
    public function listado(Request $request)
    {
        $repo=$this->getDoctrine()->getRepository(Explotacion::class);
        $explotaciones=$repo->findAll();
        return $this->render('explotacion/index.html.twig',['listaexplotaciones'=>$explotaciones]);
    }
    
    /**
     * @Route("/nuevo", name="explotacion_nuevo")
     */
    public function index(Request $request)
    {

        $repo= $this->getDoctrine()->getRepository(Explotacion::class);
        $vectorexplotaciones=$repo->findAll();

    	$explotacion=new explotacion();
    	$formu=$this->createForm(ExplotacionType::class,$explotacion);
    	$formu->handleRequest($request);

    	if ($formu->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($explotacion);

            $entityManager->flush();


			return $this->redirectToRoute('explotacion_lista', array('id' => $explotacion->getId()));    		
    	}
        
        return $this->render('explotacion/index.html.twig', [
            'vectorexplotaciones'=>$vectorexplotaciones,
            'formulario'=>$formu->createView(), 
            
        ]);
    }
}
