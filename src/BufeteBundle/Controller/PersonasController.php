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


  public function indexAsesoresAction()
  {

      $em = $this->getDoctrine()->getManager();

      $query = $em->CreateQuery(
          "SELECT p FROM BufeteBundle:Personas p
          WHERE p.role LIKE 'ROLE_ASESOR'"
        );

        $asesores = $query->getResult();

        return $this->render('personas/indexAsesores.html.twig', array(
          'asesores' => $asesores,
        ));
  }

  public function indexEstudiantesAction()
  {
    $em = $this->getDoctrine()->getManager();

/*
    $query = $em->CreateQuery(
        "SELECT p FROM BufeteBundle:Personas p
        WHERE p.role LIKE 'ROLE_ESTUDIANTE'"
      );
*/
    $query = $em->CreateQuery(
       "SELECT p FROM BufeteBundle:Personas p
        INNER JOIN BufeteBundle:Estudiantes e
        WITH p=e.idPersona"
      );

      $estudiantes = $query->getResult();

      return $this->render('personas/indexEstudiantes.html.twig', array(
          'estudiantes' => $estudiantes,

      ));
  }


  public function detalleAction(Personas $persona)
  {
      $deleteForm = $this->createDeleteForm($persona);

      return $this->render('personas/detalle.html.twig', array(
          'persona' => $persona,
          'delete_form' => $deleteForm->createView(),
      ));
  }

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







              //Se define una cadena de caractares. Te recomiendo que uses esta.
              $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
              //Obtenemos la longitud de la cadena de caracteres
              $longitudCadena=strlen($cadena);

              //Se define la variable que va a contener la contraseña
              $pass = "";
              //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
              $longitudPass=8;

              //Creamos la contraseña
              for($i=1 ; $i<=$longitudPass ; $i++){
                  //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
                  $pos=rand(0,$longitudCadena-1);

                  //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
                  $pass .= substr($cadena,$pos,1);
              }


              //echo $pass;
              //die();



          $form = $this->createForm('BufeteBundle\Form\PersonasType', $persona,
                  array(
                    'carneEnvio' => $carne,
                    'nombreEnvio'=> $nomComp,
                    'telefonoEnvio'=>$telefono,
                    'direccionEnvio'=>$direccion,
                    'correoEnvio'=>$correo,
                    'passEnvio' =>$pass,

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

      //Se define una cadena de caractares. Te recomiendo que uses esta.
      $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      //Obtenemos la longitud de la cadena de caracteres
      $longitudCadena=strlen($cadena);

      //Se define la variable que va a contener la contraseña
      $pass = "";
      //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
      $longitudPass=8;

      //Creamos la contraseña
      for($i=1 ; $i<=$longitudPass ; $i++){
          //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
          $pos=rand(0,$longitudCadena-1);

          //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
          $pass .= substr($cadena,$pos,1);
      }


        $persona = new Personas();

        $form = $this->createForm('BufeteBundle\Form\PersonasnuevasType', $persona, array(
            'passEnvio' =>$pass,
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            return $this->redirectToRoute('personas_detalle', array('idPersona' => $persona->getIdpersona()));
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
    public function showPersonasAction(Personas $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('personas/showPersonas.html.twig', array(
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

        $nomComp = $persona->getnombrePersona();
        $telefono = $persona->gettelefonoPersona();
        $direccion = $persona->getdireccionPersona();
        $correo = $persona->getemailPersona();

        $deleteForm = $this->createDeleteForm($persona);

        if($persona->getrole() == "ROLE_ESTUDIANTE")
        {
          $carne = $persona->getestudiantes()->getcarneEstudiante();
          $editForm = $this->createForm('BufeteBundle\Form\PersonasType', $persona, array(
              'nombreEnvio' => $nomComp,
              'carneEnvio'=> $carne,
              'telefonoEnvio'=>$telefono,
              'direccionEnvio'=>$direccion,
              'correoEnvio'=>$correo,

          ));
        }
        else if($persona->getrole() == "ROLE_ESTUDIANTE" || "ROLE_ASESOR" || "ROLE_SECRETARIO" ||"ROLE_DIRECTOR")
        {
          $carne = "null";
          $editForm = $this->createForm('BufeteBundle\Form\PersonasnuevasType', $persona, array(
          ));
        }
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
