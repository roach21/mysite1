<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProductType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Ctrl;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
class MagazineController extends Ctrl
{

    /**
     * @Route("/magazine/", name="magazine")
     */
    public function indexAction(Request $request) {
        // create a task and give it some dummy data for this example
        $product = new Product();

        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $product = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $em->persist($product);
             $em->flush();

            return $this->redirectToRoute('magazine_product', ['id' => $product->id]);
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/magazine/products/{id}", name="magazine_product")
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneBy(['id' => $id]);

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