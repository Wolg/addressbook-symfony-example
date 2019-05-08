<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonController extends Controller
{
    public function indexAction()
    {
        $persons = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findAll();

        return $this->render('@AppBundle/person/index.html.twig', array(
            'persons' => $persons
        ));
    }

    public function showAction($id)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);
        if (!$person) {
            throw $this->createNotFoundException('No persons found by id ' . $id);
        }
        return $this->render('@AppBundle/person/show.html.twig', array(
            'person' => $person
        ));
    }

    public function createAction()
    {
        return $this->render('@AppBundle/person/create.html.twig', array(
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
