<?php

namespace ComakeitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ComakeitBundle\Entity\Symptoms;

/**
 * Symptoms controller.
 *
 * @Route("/admin/symptoms")
 */
class SymptomsController extends Controller
{
    /**
     * Lists all Symptoms entities.
     *
     * @Route("/", name="admin_symptoms_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $symptoms = $em->getRepository('ComakeitBundle:Symptoms')->findAll();
        return $this->render('symptoms/index.html.twig', array(
            'symptoms' => $symptoms,
        ));
    }

    /**
     * Creates a new Symptoms entity.
     *
     * @Route("/new", name="admin_symptoms_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $symptom = new Symptoms();
        $form = $this->createForm('ComakeitBundle\Form\SymptomsType', $symptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($symptom);
            $em->flush();

            return $this->redirectToRoute('admin_symptoms_show', array('id' => $symptom->getId()));
        }

        return $this->render('symptoms/new.html.twig', array(
            'symptom' => $symptom,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Symptoms entity.
     *
     * @Route("/{id}", name="admin_symptoms_show")
     * @Method("GET")
     */
    public function showAction(Symptoms $symptom)
    {
        $deleteForm = $this->createDeleteForm($symptom);

        return $this->render('symptoms/show.html.twig', array(
            'symptom' => $symptom,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Symptoms entity.
     *
     * @Route("/{id}/edit", name="admin_symptoms_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Symptoms $symptom)
    {
        $deleteForm = $this->createDeleteForm($symptom);
        $editForm = $this->createForm('ComakeitBundle\Form\SymptomsType', $symptom);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($symptom);
            $em->flush();

            return $this->redirectToRoute('admin_symptoms_edit', array('id' => $symptom->getId()));
        }

        return $this->render('symptoms/edit.html.twig', array(
            'symptom' => $symptom,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Symptoms entity.
     *
     * @Route("/{id}", name="admin_symptoms_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Symptoms $symptom)
    {
        $form = $this->createDeleteForm($symptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($symptom);
            $em->flush();
        }

        return $this->redirectToRoute('admin_symptoms_index');
    }

    /**
     * Creates a form to delete a Symptoms entity.
     *
     * @param Symptoms $symptom The Symptoms entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Symptoms $symptom)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_symptoms_delete', array('id' => $symptom->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
