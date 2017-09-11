<?php

namespace BufeteBundle\Controller;

use BufeteBundle\Entity\Exoneraciones;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Exoneracione controller.
 *
 */
class ExoneracionesController extends Controller
{
    /**
     * Lists all exoneracione entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exoneraciones = $em->getRepository('BufeteBundle:Exoneraciones')->findAll();

        return $this->render('exoneraciones/index.html.twig', array(
            'exoneraciones' => $exoneraciones,
        ));
    }

    /**
     * Creates a new exoneracione entity.
     *
     */
    public function newAction(Request $request)
    {
        $exoneracione = new Exoneraciones();
        $form = $this->createForm('BufeteBundle\Form\ExoneracionesType', $exoneracione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exoneracione);
            $em->flush();

            return $this->redirectToRoute('exoneraciones_show', array('idExoneracion' => $exoneracione->getIdexoneracion()));
        }

        return $this->render('exoneraciones/new.html.twig', array(
            'exoneracione' => $exoneracione,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a exoneracione entity.
     *
     */
    public function showAction(Exoneraciones $exoneracione)
    {
        $deleteForm = $this->createDeleteForm($exoneracione);

        return $this->render('exoneraciones/show.html.twig', array(
            'exoneracione' => $exoneracione,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing exoneracione entity.
     *
     */
    public function editAction(Request $request, Exoneraciones $exoneracione)
    {
        $deleteForm = $this->createDeleteForm($exoneracione);
        $editForm = $this->createForm('BufeteBundle\Form\ExoneracionesType', $exoneracione);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exoneraciones_edit', array('idExoneracion' => $exoneracione->getIdexoneracion()));
        }

        return $this->render('exoneraciones/edit.html.twig', array(
            'exoneracione' => $exoneracione,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a exoneracione entity.
     *
     */
    public function deleteAction(Request $request, Exoneraciones $exoneracione)
    {
        $form = $this->createDeleteForm($exoneracione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exoneracione);
            $em->flush();
        }

        return $this->redirectToRoute('exoneraciones_index');
    }

    /**
     * Creates a form to delete a exoneracione entity.
     *
     * @param Exoneraciones $exoneracione The exoneracione entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Exoneraciones $exoneracione)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exoneraciones_delete', array('idExoneracion' => $exoneracione->getIdexoneracion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
