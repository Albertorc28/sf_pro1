<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
     * @Route("/pizza")
     */

class PizzaController extends Controller
{
    /**
     * @Route("", name="pizza")
     */
    public function index()
    {
    	$pizzas=array("Margarita","Carbonara","Hawaiana","Barbacoa","Romana","4 Quesos","Mexicana","Turca","Pollo");
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'minombre' => 'Alberto',
            'pizzas' => $pizzas
        ]);
    }

        /**
     * @Route("/nuevo", name="pizza_nuevo")
     */
    public function nuevaPizza()
    {
    	
        return $this->render('pizza/nuevo.html.twig', [
         
        ]);
    }

            /**
     * @Route("editar", name="pizza_editar")
     */
    public function editarPizza()
    {
    	
        return $this->render('pizza/editar.html.twig', [
         
        ]);
    }


            /**
     * @Route("/mostrar", name="pizza_mostrar")
     */
    public function mostrarPizza()
    {
    	$ingredientes=array("Bacon","Jamón","Mozarella","Piña","Pepperoni","Atún");
        return $this->render('pizza/mostrar.html.twig', [
        	'ingredientes' => $ingredientes
   
        ]);
    }


            /**
     * @Route("/nombre/{parametro}", name="pizza_nombre")
     */
    public function nombrePizza($parametro)
    {
    	
        return $this->render('pizza/nombre.html.twig', [
        	'cliente'=>$parametro
         
        ]);
    }

	/**
     * @Route("/calcular/{precio}", name="blog_list", requirements={"page"="\d+"})
     */
    public function calcularPizza($precio)
    {
    	$final=$precio*1.21;
        return $this->render('pizza/nombre.html.twig', [
        	'preciofinal' => $final."€"
   
        ]);
    }
}

