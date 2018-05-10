<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
     * @Route("/ingrediente")
     */
class IngredienteController extends Controller
{
    /**
     * @Route("", name="ingrediente")
     */
    public function index()
    {
    	$ingredientes=array("Bacon","Jamón","Mozarella","Piña","Pepperoni","Atún");
        return $this->render('ingrediente/index.html.twig', [
            'controller_name' => 'IngredienteController',
            'ingredientes'=>$ingredientes
        ]);
    }

        /**
     * @Route("/nuevo", name="ingrediente_nuevo")
     */
    public function ingredientePizza()
    {
    	
        return $this->render('ingrediente/nuevo.html.twig', [
         
        ]);
    }
}
