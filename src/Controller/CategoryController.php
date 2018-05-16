<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
* @Route("/category")
*/
class CategoryController extends Controller
{
   /**
    * @Route("/lista", name="category_lista")
    */
   public function lista(Request $request)
   {
       $repo = $this->getDoctrine()->getRepository(Category::class);
       $categories = $repo->findAll();        
       return $this->render('category/index.html.twig', [
       	'listacategory' => $categories        
       ]);
   }

    /**
    * @Route("/nuevo", name="category_nuevo")
    */
   public function index(Request $request)
   {
       $repo = $this->getDoctrine()->getRepository(Category::class);
       $vectorcategories = $repo->findAll();       
       $category= new category();
       $formu = $this->createForm(CategoryType::class, $category);
       $formu->handleRequest($request);        
       if ($formu->isSubmitted()){   

       		 $entityManager = $this->getDoctrine()->getManager();
           	$entityManager->persist($category);
           	$entityManager->flush();            
           	
           	return $this->redirectToRoute('category_lista');
       }        

       return $this->render('category/nuevo.html.twig', [
       		'vectorcategories' => $vectorcategories,
           	'formulario' => $formu->createView()        

       ]);
   }
}
