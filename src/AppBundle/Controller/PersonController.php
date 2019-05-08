<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\PersonType;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function createAction(Request $request, FileUploader $fileUploader)
    {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $person->getPicture();
            $fileName = $fileUploader->upload($file);
            $person->setPicture($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            $this->addFlash(
                'success',
                'Created successfully!'
            );
            return $this->redirect('/');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'warning',
                'Something went wrong!'
            );
        }

        return $this->render('@AppBundle/person/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction($id, Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository(Person::class)->find($id);
        if (!$person) {
            throw $this->createNotFoundException('No persons found by id ' . $id);
        }

        $form = $this->createForm(PersonType::class, $person);
        $prevPicture = $person->getPicture();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $person->getPicture();
            if ($prevPicture && !$file) {
                $person->setPicture($prevPicture);
            } elseif($file) {
                $fileName = $fileUploader->upload($file);
                $person->setPicture($fileName);
            }

            $em->flush();
            $this->addFlash(
                'success',
                'Updated successfully!'
            );
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'warning',
                'Something went wrong!'
            );
        }

        return $this->render('@AppBundle/person/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction()
    {
        return $this->render('AppBundle:Person:delete.html.twig', array(
            // ...
        ));
    }

}
