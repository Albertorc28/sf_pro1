<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/tienda")
     */
class TiendaController extends Controller
{
	const EMPLEADOS=array("Angela","Rita","Pedro","Erika","Juan");
    
	/**
     * @Route("", name="tienda_empleados")
     */
    public function empleados()
    {
        return $this->render('tienda/index.html.twig', [
            'empleados'=>self::EMPLEADOS
        ]);
    }

    /**
     * @Route("/detalle/{parametro}", name="tienda_detalle", requirements={"page"="\d+"})
     */
     public function detalleEmpleado($parametro)
    {
        return $this->render('tienda/detalle.html.twig', [
            'empleado' =>self::EMPLEADOS[$parametro]
        ]);
    }



/*
    public function index()
    {
        return $this->render('tienda/index.html.twig', [
            'controller_name' => 'TiendaController',
        ]);
    }
    */
}
