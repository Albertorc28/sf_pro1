<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cliente;
use App\Form\ClienteType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/cliente")
*/

class ClienteController extends Controller
{
    /**
     * @Route("/lista", name="cliente_lista")
     */

    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repo->findAll();        
        return $this->render('cliente/index.html.twig', [
        'listacliente' => $clientes      
       ]);
   }

   	/**
    * @Route("/nuevo", name="cliente_nuevo")
    */
    public function index(Request $request)
    {
      $cliente = new Cliente();
      $formu = $this->createForm(ClienteType::class, $cliente);
        //Para poder cogerlo despues
      $formu->handleRequest($request);
        //El isSubmitted() es enviar algo en este caso un formulario

      if ($formu->isSubmitted()){
        dump($cliente);
            //Esta primera es la que llamas a la base de datos Doctrine//
            $em = $this->getDoctrine()->getManager();
            //Esta es para persistir los datos que persisten ahi//
            $em->persist($cliente);
            //El flush es como un commit ¿ya esta todo? pues ahora si coge todos los dias//
            $em->flush();
            //Esto es para que cuando se creen personas en el formulario los mande a la lista
        
      }
        return $this->render('cliente/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
}
