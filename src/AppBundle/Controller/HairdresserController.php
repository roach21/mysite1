<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use AppBundle\Form\HairdresserType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Ctrl;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Hairdresser;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
class HairdresserController extends Ctrl
{

    /**
     * @Route("/Hairdresser/", name="Hairdresser")
     */
    public function indexAction(Request $request) {
        // create a task and give it some dummy data for this example
        $service = new service();

        $form = $this->createForm(HairdresserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $service = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('hairdresser_service', ['id' => $service->id]);
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/hairdresser/service/{id}", name="hairdresser_service")
     */
    public function showAction($id)
    {
        $service = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findOneBy(['id' => $id]);

        if (!$service) {
            throw $this->createNotFoundException(
                'No service found for id '.$id
            );
        }
        return $this->render('default/index.html.twig', [
            'service' => $service
        ]);
    }
}