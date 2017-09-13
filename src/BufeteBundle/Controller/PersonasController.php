<?php

namespace BufeteBundle\Controller;

use BufeteBundle\Entity\Personas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use BufeteBundle\Entity\Estudiantes;
use BufeteBundle\Form\PersonasType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use BufeteBundle\Entity\Post;


/**
 * Persona controller.
 *
 */
class PersonasController extends Controller
{


  public function registroAction(Request $request)
  {


    $nomComp ="";
    $carrera ="";
    $telefono="";
    $correo="";
    $direccion="";
    $muni_dep="";

    $var=$request->query->get("carne");
    $nuevavar = (int)$var;
    $carne=$var;

      header('Content-Type: text/html; charset=UTF-8');
      include ("lib/libryeser.php");
      include ("lib/parsexml.php");
      require_once("lib/nusoap/nusoap.php");

        if(isset($carne) && is_numeric($carne))
        {
            $ciclo=date('Y');
            $unidad=12;
            //$carne=$_GET['carne'];
            //$acceso="<DEPENDENCIA>UA12</DEPENDENCIA><LOGIN>NS1DREAMHOSTCOM</LOGIN><PWD>9eee79041ce54db94eddd57a2ab8a929</PWD>";
            $acceso="<DEPENDENCIA>UA12</DEPENDENCIA><LOGIN>20040750</LOGIN><PWD>d7476d19</PWD>";
            $xml03="<VERIFICAR_NUEVO>".$acceso."<CARNET>".$carne."</CARNET>
                    <UNIDAD_ACADEMICA>".$unidad."</UNIDAD_ACADEMICA><CICLO>".$ciclo."</CICLO></VERIFICAR_NUEVO>";

            $url="http://rye.usac.edu.gt/WS/verificadatosRyEv01.php?wsdl";

            $res03 = verificar_con_RYE("VerificaNuevos", "xml_verificaNuevos", $xml03,$url);
            $xml02="<VERIFICAR_CARRERAS>".$acceso."<CARNET>".$carne."</CARNET>
                    <UNIDAD_ACADEMICA>12</UNIDAD_ACADEMICA><CICLO>".$ciclo."</CICLO></VERIFICAR_CARRERAS>";

            $url="http://rye.usac.edu.gt/WS/verificadatosRyEv01.php?wsdl";

            $res02 = verificar_con_RYE("VerificaCarreras", "xml_verificaCarreras", $xml02,$url);
            $res03 = "<?xml version='1.0' encoding='UTF-8'?>".$res03;
            $res02 = "<?xml version='1.0' encoding='UTF-8'?>".$res02;

            $datos = new \SimpleXMLElement($res03);
            $datos1 = new \SimpleXMLElement($res02);

            //echo $datos->MSG;

            if(isset($datos->STATUS,$datos->DATOS[0]->CARNET,$datos->DATOS[0]->NOM1))
            {
                $carne = $datos->DATOS[0]->CARNET;
                $nomComp =$datos->DATOS[0]->NOM1." ".$datos->DATOS[0]->NOM2." ".$datos->DATOS[0]->NOM3." ".$datos->DATOS[0]->APE1." ".$datos->DATOS[0]->APE2;
                $carrera =$datos1->REGISTRO->CARRERA;;
                $telefono=$datos->DATOS->TELEFONO;
                $correo=$datos->DATOS->CORREO;
                $direccion=$datos->DATOS->DIRECCION;
                $muni_dep=$datos->DATOS->MUNICIPIO." ".$datos->DATOS->DEPARTAMENTO;
            }
          }



          $persona = new Personas();
          $estudiantes = new Estudiantes();
          $persona->setEstudiantes($estudiantes);


          //echo "llego aqui";
          //die();

          $form = $this->createForm('BufeteBundle\Form\PersonasType', $persona,
                  array(
                    'carneEnvio' => $carne,
                    'nombreEnvio'=> $nomComp,
                    'telefonoEnvio'=>$telefono,
                    'direccionEnvio'=>$direccion,
                    'correoEnvio'=>$correo,

                  ));


          $form->handleRequest($request);


          $unavariable="";
          if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();
              $unavariable = $persona->getIdPersona();
              //echo "asdfasdfadsfadsafdsafdsafds     ".$unavariable;
              return $this->redirectToRoute('personas_show', array('idPersona' => $persona->getIdPersona()));
          }



          return $this->render('personas/registro.html.twig', array(
              'persona' => $persona,
              'form' => $form->createView(),
                  'carne' => $carne,
                  'nombre' => $nomComp,
                  'carrera' => $carrera,
                  'telefono' => $telefono,
                  'correo' => $correo,
                  'direccion' => $direccion." ".$muni_dep,
              ));
    }

    /**
     * Lists all persona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personas = $em->getRepository('BufeteBundle:Personas')->findAll();

        return $this->render('personas/index.html.twig', array(
            'personas' => $personas,
        ));
    }

    /**
     * Creates a new persona entity.
     *
     */
    public function newAction(Request $request)
    {
        $persona = new Personas();

        $form = $this->createForm('BufeteBundle\Form\PersonasnuevasType', $persona);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            return $this->redirectToRoute('personas_show', array('idPersona' => $persona->getIdpersona()));
        }

        return $this->render('personas/new.html.twig', array(
            'persona' => $persona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a persona entity.
     *
     */
    public function showAction(Personas $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('personas/show.html.twig', array(
            'persona' => $persona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing persona entity.
     *
     */
    public function editAction(Request $request, Personas $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('BufeteBundle\Form\PersonasType', $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personas_edit', array('idPersona' => $persona->getIdpersona()));
        }

        return $this->render('personas/edit.html.twig', array(
            'persona' => $persona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a persona entity.
     *
     */
    public function deleteAction(Request $request, Personas $persona)
    {
        $form = $this->createDeleteForm($persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persona);
            $em->flush();
        }

        return $this->redirectToRoute('personas_index');
    }

    /**
     * Creates a form to delete a persona entity.
     *
     * @param Personas $persona The persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Personas $persona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personas_delete', array('idPersona' => $persona->getIdpersona())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
