<?php

namespace BufeteBundle\Controller;

use BufeteBundle\Entity\Infofinal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Infofinal controller.
 *
 */
class InfofinalController extends Controller
{
    /**
     * Lists all infofinal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infofinals = $em->getRepository('BufeteBundle:Infofinal')->findAll();

        return $this->render('infofinal/index.html.twig', array(
            'infofinals' => $infofinals,
        ));
    }

    /**
     * Creates a new infofinal entity.
     *
     */
    public function newAction(Request $request)
    {
        $infofinal = new Infofinal();
        $form = $this->createForm('BufeteBundle\Form\InfofinalType', $infofinal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $infofinal->getRutaInfo();

            //dump($file);
            //die();

            if(($file instanceof UploadedFile) && ($file->getError() == '0'))
            {


              $validator = $this->get('validator');
              $errors = $validator->validate($infofinal);

              if (count($errors) > 0) {
                  /*
                   * Uses a __toString method on the $errors variable which is a
                   * ConstraintViolationList object. This gives us a nice string
                   * for debugging.
                   */
                  $errorsString = (string) $errors;

                  return new Response($errorsString);
              }

              // Generar un numbre único para el archivo antes de guardarlo
              $fileName = md5(uniqid()).'.'.$file->guessExtension();



              // Mover el archivo al directorio donde se guardan los curriculums
              $cvDir = $this->container->getparameter('kernel.root_dir').'/../web/uploads/final';
              $file->move($cvDir, $fileName);

              // Actualizar la propiedad curriculum para guardar el nombre de archivo PDF
              // en lugar de sus contenidos
              $infofinal->setrutaInfo($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($infofinal);
            $em->flush();

            return $this->redirectToRoute('infofinal_show', array('idIfno' => $infofinal->getIdifno()));
        }

        return $this->render('infofinal/new.html.twig', array(
            'infofinal' => $infofinal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a infofinal entity.
     *
     */
    public function showAction(Infofinal $infofinal)
    {
        $deleteForm = $this->createDeleteForm($infofinal);

        return $this->render('infofinal/show.html.twig', array(
            'infofinal' => $infofinal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing infofinal entity.
     *
     */
    public function editAction(Request $request, Infofinal $infofinal)
    {
        $deleteForm = $this->createDeleteForm($infofinal);
        $editForm = $this->createForm('BufeteBundle\Form\InfofinalType', $infofinal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infofinal_edit', array('idIfno' => $infofinal->getIdifno()));
        }

        return $this->render('infofinal/edit.html.twig', array(
            'infofinal' => $infofinal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a infofinal entity.
     *
     */
    public function deleteAction(Request $request, Infofinal $infofinal)
    {
        $form = $this->createDeleteForm($infofinal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($infofinal);
            $em->flush();
        }

        return $this->redirectToRoute('infofinal_index');
    }

    /**
     * Creates a form to delete a infofinal entity.
     *
     * @param Infofinal $infofinal The infofinal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Infofinal $infofinal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infofinal_delete', array('idIfno' => $infofinal->getIdifno())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
