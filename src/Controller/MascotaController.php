<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mascota;
use App\Form\MascotaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/mascota")
*/

class MascotaController extends Controller
{
    /**
     * @Route("/lista", name="mascota_lista")
     */

    public function lista(Request $request)
    {
         
       $repo = $this->getDoctrine()->getRepository(Mascota::class);
       $mascotas = $repo->findAll();        
       return $this->render('mascota/index.html.twig', [
        'listamascota' => $mascotas      
       ]);
   }
    /**
    * @Route("/nuevo", name="mascota_nuevo")
    */
    public function index(Request $request)
    {
      $mascota = new Mascota();
      $formu = $this->createForm(MascotaType::class, $mascota);
        //Para poder cogerlo despues
      $formu->handleRequest($request);
        //El isSubmitted() es enviar algo en este caso un formulario

      if ($formu->isSubmitted()){
        dump($mascota);
            //Esta primera es la que llamas a la base de datos Doctrine//
            $em = $this->getDoctrine()->getManager();
            //Esta es para persistir los datos que persisten ahi//
            $em->persist($mascota);
            //El flush es como un commit ¿ya esta todo? pues ahora si coge todos los dias//
            $em->flush();
            //Esto es para que cuando se creen personas en el formulario los mande a la lista
      return $this->redirectToRoute('cliente_detalle', array('id' => $mascota->getCliente()->getId()));
        
      }
        return $this->render('mascota/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
}
