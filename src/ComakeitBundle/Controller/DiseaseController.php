<?php

namespace ComakeitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ComakeitBundle\Entity\Disease;

/**
 * Disease controller.
 *
 * @Route("/admin/disease")
 */
class DiseaseController extends Controller
{
    /**
     * Lists all Disease entities.
     *
     * @Route("/", name="admin_disease_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diseases = $em->getRepository('ComakeitBundle:Disease')->findAll();

        return $this->render('disease/index.html.twig', array(
            'diseases' => $diseases,
        ));
    }

    /**
     * Creates a new Disease entity.
     *
     * @Route("/new", name="admin_disease_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $disease = new Disease();
        $form = $this->createForm('ComakeitBundle\Form\DiseaseType', $disease);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disease);
            $em->flush();

            return $this->redirectToRoute('admin_disease_show', array('id' => $disease->getId()));
        }

        return $this->render('disease/new.html.twig', array(
            'disease' => $disease,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Disease entity.
     *
     * @Route("/{id}", name="admin_disease_show")
     * @Method("GET")
     */
    public function showAction(Disease $disease)
    {
        $deleteForm = $this->createDeleteForm($disease);

        return $this->render('disease/show.html.twig', array(
            'disease' => $disease,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Disease entity.
     *
     * @Route("/{id}/edit", name="admin_disease_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Disease $disease)
    {
        $deleteForm = $this->createDeleteForm($disease);
        $editForm = $this->createForm('ComakeitBundle\Form\DiseaseType', $disease);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disease);
            $em->flush();

            return $this->redirectToRoute('admin_disease_edit', array('id' => $disease->getId()));
        }

        return $this->render('disease/edit.html.twig', array(
            'disease' => $disease,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Disease entity.
     *
     * @Route("/{id}", name="admin_disease_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Disease $disease)
    {
        $form = $this->createDeleteForm($disease);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($disease);
            $em->flush();
        }

        return $this->redirectToRoute('admin_disease_index');
    }

    /**
     * Creates a form to delete a Disease entity.
     *
     * @param Disease $disease The Disease entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Disease $disease)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_disease_delete', array('id' => $disease->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
