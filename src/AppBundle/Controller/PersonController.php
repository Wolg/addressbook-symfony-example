<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Person:index.html.twig', array(
            // ...
        ));
    }

    public function showAction()
    {
        return $this->render('AppBundle:Person:show.html.twig', array(
            // ...
        ));
    }

    public function createAction()
    {
        return $this->render('AppBundle:Person:create.html.twig', array(
            // ...
        ));
    }

    public function updateAction()
    {
        return $this->render('AppBundle:Person:update.html.twig', array(
            // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('AppBundle:Person:delete.html.twig', array(
            // ...
        ));
    }

}
