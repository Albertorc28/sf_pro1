<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Perro;
use App\Form\PerroType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

 /**
     * @Route("/perro")
     */
class PerroController extends Controller
{
	
    /**
     * @Route("/nuevo", name="perro_lista")
     */

    public function listado()
    {
    	$repo= $this->getDoctrine()->getRepository(Perro::class);
        $vectorperros=$repo->findAll();

    	dump($vectorperros);
    	return $this->render('perro/index.html.twig', [
            'vectorperros'=>$vectorperros,
        ]);
    }
	
	/**
     * @Route("/nuevo", name="perro_nuevo")
     */

    public function nuevo(Request $request)
    {
    	$perro=new Perro();
    	$formu=$this->createForm(PerroType::class,$perro);
    	$formu->handleRequest($request);
    	if ($formu->isSubmitted()) {
    		dump($perro);
    		
    		return $this->render('perro/final.html.twig',[

    		]);
    		
    	}
    	return $this->render('perro/nuevo.html.twig',[
    		'formulario'=>$formu->createView()
    	]);
    }

}
