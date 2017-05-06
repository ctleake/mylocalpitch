<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

// RESTful API
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

/* RESTful API
class DefaultController extends Controller
*/
class DefaultController extends FOSRestController
{
    /**
     * replaced
     * @Route("/", name="homepage")
     * with
     * @Rest\Get("/")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
        */
        // RESTful API
        $data = ['hello' => 'world'];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;
    }
}
