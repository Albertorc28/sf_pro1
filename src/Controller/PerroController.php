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
	private $vectorperros;
	private function cargarDatos(){
		$this->vectorperros[]=new Perro()->setNombre("Lassie")->setRaza("Labrador");
		$this->vectorperros[]=new Perro()->setNombre("Curro")->setRaza("Collie");
		$this->vectorperros[]=new Perro()->setNombre("Tobbie")->setRaza("Chiguagua");

		$p1=new Perro();
		$p1->setNombre("Luna");
		$p1->setRaza("Yorkshire");
		$this->vectorperros[]=$p1;
	}
    /**
     * @Route("/nuevo", name="perro_lista")
     */

    public function listado()
    {
    	$this->cargarDatos();
    	dump($this->vectorperros);
    	return $this->render('perro/index.html.twig', [
            'vectorperros'=>$this->vectorperros,
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
