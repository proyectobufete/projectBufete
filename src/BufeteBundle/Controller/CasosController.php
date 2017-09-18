<?php

namespace BufeteBundle\Controller;

use BufeteBundle\Entity\Casos;
use BufeteBundle\Entity\Laborales;
use BufeteBundle\Entity\Civiles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Caso controller.
 *
 */
class CasosController extends Controller
{
    /**
     * Lists all caso entities.
     *
     */
    public function indexLaboralesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
          "SELECT c FROM BufeteBundle:Casos c
          INNER JOIN BufeteBundle:Laborales l WITH c = l.idCaso"
        );
        $casos = $query->getResult();

        //$casos = $em->getRepository('BufeteBundle:Casos')->findAll();

        return $this->render('casos/indexlaborales.html.twig', array(
            'casos' => $casos,
        ));
    }

    /**
     * Listar casos civiles.
     *
     */
    public function indexCivilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
          "SELECT c FROM BufeteBundle:Casos c
          INNER JOIN BufeteBundle:Civiles ci WITH c = ci.idCaso"
        );
        $casos = $query->getResult();

        //$casos = $em->getRepository('BufeteBundle:Casos')->findAll();

        return $this->render('casos/indexciviles.html.twig', array(
            'casos' => $casos,
        ));
    }

    /**
     * Creates a new caso entity.
     *
     */
    public function newLaboralAction(Request $request)
    {
        $caso = new Casos();
        $laboral = new Laborales();
        $caso->setLaborales($laboral);
        //$user = $this->getUser()->getIdPersona();
        $idciudad = $this->getUser()->getIdBufete()->getIdCiudad()->getIdCiudad();
        $idasignatario = $this->getUser()->getIdPersona();

        $id_estudiante = null; $cantidad = null; $laborales = null; $flush = null; $mensaje = null;

        $form = $this->createForm('BufeteBundle\Form\CasosType', $caso, array('idciudad'=> $idciudad));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $tipocaso_repo = $em->getRepository("BufeteBundle:Tipocaso");
            $tipo = $tipocaso_repo->find(2);
            $caso->setIdTipo($tipo);
            $caso->setAsignatarioCaso($idasignatario);
            $id_estudiante = $form->get('idEstudiante')->getData()->getIdEstudiante();

            $db = $em->getConnection();
            $query = "SELECT count(laborales.Id_Caso) as Laborales
              FROM casos
              	INNER JOIN laborales
              			ON casos.Id_Caso = laborales.Id_Caso
              where casos.Id_Estudiante = ? and casos.Estado_Caso = 1
              group by casos.Id_Estudiante";
            $stmt = $db->prepare($query);
            $params = array($id_estudiante);
            $stmt->execute($params);
            $cantidad = $stmt->fetchAll();

            foreach ($cantidad as $cant) {
                $laborales = $cant["Laborales"];
            }

            if ($laborales < 2) {
              $em->persist($caso);
              $flush = $em->flush();
              $flush=true;
                if($flush == true){
                    $mensaje = "Se registro correctamente el caso";
                } else{
                    $mensaje = "No se pudo registrar correctamente el caso";
                }
              return $this->redirectToRoute('casos_showlaboral', array('idCaso' => $caso->getIdcaso()));
            } else {
              $mensaje = "Ha llegado al limite de casos laborales";
            }
        }

        return $this->render('casos/newlaboral.html.twig', array(
            'caso' => $caso,
            'form' => $form->createView(),
            'mensaje' => $mensaje,
          //  'usuario' => $user,
        ));
    }

    /**
    * Crear casos civiles
    */
    public function newCivilAction(Request $request)
    {
        $caso = new Casos();
        $civil = new Civiles();
        $caso->setCiviles($civil);
        $idciudad = $this->getUser()->getIdBufete()->getIdCiudad()->getIdCiudad();
        $idasignatario = $this->getUser()->getIdPersona();

        $id_estudiante = null; $cantidad = null; $civiles = null; $flush = null; $mensaje = null;

        $form = $this->createForm('BufeteBundle\Form\CasocivilType', $caso, array('idciudad'=> $idciudad));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $tipocaso_repo = $em->getRepository("BufeteBundle:Tipocaso");
            $tipo = $tipocaso_repo->find(1);
            $caso->setIdTipo($tipo);
            $caso->setAsignatarioCaso($idasignatario);

            $id_estudiante = $form->get('idEstudiante')->getData()->getIdEstudiante();

            $db = $em->getConnection();
            $query = "SELECT count(civiles.Id_Caso) as Civiles
              FROM casos
              	INNER JOIN civiles
              			ON casos.Id_Caso = civiles.Id_Caso
              where casos.Id_Estudiante = ? and casos.Estado_Caso = 1
              group by casos.Id_Estudiante";
            $stmt = $db->prepare($query);
            $params = array($id_estudiante);
            $stmt->execute($params);
            $cantidad = $stmt->fetchAll();

            foreach ($cantidad as $cant) {
                $civiles = $cant["Civiles"];
            }

            if ($civiles < 1) {
              $em->persist($caso);
              $flush = $em->flush();
                if($flush == true){
                    $mensaje = "Se registro correctamente el caso";
                } else{
                    $mensaje = "No se pudo registrar correctamente el caso";
                }
              return $this->redirectToRoute('casos_showcivil', array('idCaso' => $caso->getIdcaso()));
            } else {
              $mensaje = "Ha llegado al limite de casos civiles";
            }
        }

        return $this->render('casos/newcivil.html.twig', array(
            'caso' => $caso,
            'form' => $form->createView(),
            'mensaje' => $mensaje,
        ));
    }

    /**
     * Detalle caso laboral
     *
     */
    public function showLaboralAction(Casos $caso)
    {
        $deleteForm = $this->createDeleteForm($caso);
        return $this->render('casos/showlaboral.html.twig', array(
            'caso' => $caso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Detalle caso civil
     *
     */
    public function showCivilAction(Casos $caso)
    {
        $deleteForm = $this->createDeleteForm($caso);

        return $this->render('casos/showcivil.html.twig', array(
            'caso' => $caso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Editar caso laboral
     *
     */
    public function editLaboralAction(Request $request, Casos $caso)
    {
        $deleteForm = $this->createDeleteForm($caso);
        $idciudad = $caso->getIdDemandante()->getIdCiudad()->getIdCiudad();
        $editForm = $this->createForm('BufeteBundle\Form\CasosType', $caso, array('idciudad'=> $idciudad));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('casos_showlaboral', array('idCaso' => $caso->getIdcaso()));
        }

        return $this->render('casos/editlaboral.html.twig', array(
            'caso' => $caso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Editar caso civil
     *
     */
    public function editCivilAction(Request $request, Casos $caso)
    {
        $deleteForm = $this->createDeleteForm($caso);
        $idciudad = $caso->getIdDemandante()->getIdCiudad()->getIdCiudad();
        $editForm = $this->createForm('BufeteBundle\Form\CasocivilType', $caso, array('idciudad'=> $idciudad));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('casos_showcivil', array('idCaso' => $caso->getIdcaso()));
        }

        return $this->render('casos/editcivil.html.twig', array(
            'caso' => $caso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a caso entity.
     *
     */
    public function deleteAction(Request $request, Casos $caso)
    {
        $form = $this->createDeleteForm($caso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($caso);
            $em->flush();
        }

        return $this->redirectToRoute('casos_index');
    }

    /**
     * Creates a form to delete a caso entity.
     *
     * @param Casos $caso The caso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Casos $caso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('casos_delete', array('idCaso' => $caso->getIdcaso())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
