<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Image;
use AppBundle\Form\ImageType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   $image=new Image();
     //   $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted()){$em = $this->getDoctrine()->getManager();  
            $em->persist($image);
            $em->flush();}
        // replace this example code with whatever yo
        return $this->render('default/index.html.twig', ['form'=>$form->createView()
        ]);
    }
}
