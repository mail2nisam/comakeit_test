<?php

namespace ComakeitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();

        $diseases = $em->getRepository('ComakeitBundle:Disease')->findAll();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $diseases,
        $request->query->get('page', 1)/*page number*/,
        5/*limit per page*/
         );
        
        return $this->render('home/index.html.twig',['disease_paginated'=>$pagination]);
    }
}
