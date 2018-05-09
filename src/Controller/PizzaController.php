<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PizzaController extends Controller
{
    /**
     * @Route("/pizza", name="pizza")
     */
    public function index()
    {
    	$pizzas=array("Margarita","Carbonara","Hawaiana","Barbacoa","Romana","4 Quesos","Mexicana","Turca","Pollo");
    	$ingredientes=array("Bacon","Jamón","Mozarella","Piña","Pepperoni","Atún");
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'minombre' => 'Alberto',
            'pizzas' => $pizzas,
            'ingredientes' => $ingredientes
        ]);
    }

        /**
     * @Route("/pizza/nuevo", name="pizza_nuevo")
     */
    public function nuevaPizza()
    {
    	
        return $this->render('pizza/index.html.twig', [
         
        ]);
    }
}
