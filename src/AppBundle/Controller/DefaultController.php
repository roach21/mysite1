<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Ctrl;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Ctrl
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();
		
		$product = new Product();
		
		$product->name = 'strapon';
		$product->description = 'pihat\' petrushke v jopy';
		$product->price = 9999;
		
		 // tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist($product);

		// actually executes the queries (i.e. the INSERT query)
		$em->flush();
		
		 return new Response('Saved new product with id '.$product->id);
	
        // replace this example code with whatever you need
        //return $this->render('default/index.html.twig', [
        //    'product' => $product
        //]);
    }
	
	/**
     * @Route("/products/{id}", name="products")
     */
    public function showAction($id)
	{
		$product = $this->getDoctrine()
			->getRepository(Product::class)
			->find($id);

		if (!$product) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}
		return $this->render('default/index.html.twig', [
			'product' => $product
		]);
	}
}
