<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Producto;
use App\Form\ProductoType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
* @Route("/producto")
*/
class ProductoController extends Controller
{
   /**
    * @Route("/lista", name="producto_lista")
    */
   public function lista(Request $request)
   {
       $repo = $this->getDoctrine()->getRepository(Producto::class);
       $productos = $repo->findAll();        
       return $this->render('producto/index.html.twig', [
       	'listaproducto' => $productos       
       ]);
   }

    /**
    * @Route("/nuevo", name="producto_nuevo")
    */
   public function index(Request $request)
   {
       $repo = $this->getDoctrine()->getRepository(Producto::class);
       $vectorproductos = $repo->findAll();       
       $producto= new producto();
       $formu = $this->createForm(ProductoType::class, $producto);
       $formu->handleRequest($request);        
       if ($formu->isSubmitted()){   

       		$entityManager = $this->getDoctrine()->getManager();
           	$entityManager->persist($producto);
           	$entityManager->flush();            
           	
           	return $this->redirectToRoute('producto_lista');
       }        

       return $this->render('producto/nuevo.html.twig', [
       		'vectorproductos' => $vectorproductos,
           	'formulario' => $formu->createView()        

       ]);
   }
}
