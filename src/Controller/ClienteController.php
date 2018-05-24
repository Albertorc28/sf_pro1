<?php

namespace App\Controller;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    /**
    * @Route("/detalle/{id}", name="cliente_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
   {
              $repo = $this->getDoctrine()->getRepository(Cliente::class);
              $cliente = $repo->find($id);
              dump($cliente);          
               return $this->render('cliente/detalle.html.twig', [      
                'cliente' => $cliente      
                ]);
   }




    /**
     * @Route("/jsonlist", name="cliente_jsonlist")
     */
    public function jsonClientes()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );
        $serializer = new Serializer(array($normalizer), array($encoder));
        $repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repo->findAll();
        $jsonClientes = $serializer->serialize($clientes, 'json');        
        $respuesta = new Response($jsonClientes);
        return $respuesta;
    }
        







        /*$repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repo->findAll();

        $request= Request :: CreateFromGlobals();
        $response = new Response();
        $response->setContent(json_encode($clientes
        ));
        $response-> headers ->set('Content-Type', 'application/json');
        
        dump($clientes);
        return $response;*/
}
