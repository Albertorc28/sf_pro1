<?php



namespace App\Controller;



use Symfony\Component\HttpFoundation\Request;

use App\Entity\Consulta;

use App\Form\ConsultaType;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;





 /**

     * @Route("/consulta")

     */

class ConsultaController extends Controller

{

    /**

     * @Route("/lista", name="consulta_lista")

     */

    public function listado(Request $request)

    {
        $repo = $this->getDoctrine()->getRepository(Consulta::class);
        $vectorconsulta = $repo->findAll();

        dump ($vectorconsulta);

        return $this->render('consulta/index.html.twig', [

        'vectorconsulta' => $vectorconsulta,
        ]);
    }
    /**
     * @Route("/nuevo", name="consulta_nuevo")
     */
    public function index(Request $request)

    {

      $consulta = new Consulta();

      $formu = $this->createForm(ConsultaType::class, $consulta);
      $formu->handleRequest($request);
      if ($formu->isSubmitted()){
        dump($consulta);
            $em = $this->getDoctrine()->getManager();
            $em->persist($consulta);
            $em->flush();



            //Esto es para que cuando se creen personas en el formulario los mande a la lista directamente

         return $this->redirectToRoute('consulta_lista');

          

      }



        return $this->render('consulta/nuevo.html.twig', [

            'formulario' => $formu->createView(),

        ]);

    }

}