<?php

namespace BufeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $this->carneEnvio = $options['carneEnvio'];
      $this->nomEnvio = $options['nombreEnvio'];
      $this->telEnvio = $options['telefonoEnvio'];
      $this->dirEnvio = $options['direccionEnvio'];
      $this->corEnvio = $options['correoEnvio'];

      $builder

      //form DATOS PERSONALES

        ->add('nombrePersona',TextType::Class, array ("data"=>$this->nomEnvio))
        ->add('telefonoPersona',TextType::Class, array ("data"=>$this->telEnvio))
        ->add('direccionPersona',TextType::Class, array ("data"=>$this->dirEnvio))
        ->add('emailPersona',TextType::Class, array ("data"=>$this->corEnvio))
        ->add('usuarioPersona',TextType::Class, array ("label"=>"Usuario"))
        ->add('passPersona')
        ->add('estadoPersona')
        ->add('estadoPersona',ChoiceType::class,array(
                "label" => "Estado",
                    "choices"=> array(
                        "ACTIVO" =>1,
                        "INACTIVO" =>0,
              ),
                'expanded'  => true,
                'multiple'  => false,
            ))
            //->add('role')
            ->add('role', ChoiceType::class,array(
                "label" => "Roles",
                    "choices"=> array(
                        "Estudiante" =>"ROLE_ESTUDIANTE",
              ),
                'expanded'  => true,
                //'multiple'  => true,
            ))
            ->add('idBufete')
            //form DATOS DE ESTUDIO
            ->add('estudiantes', 'BufeteBundle\Form\EstudiantesType', array(
                'label'=>'DATOS DE ESTUDIO',
                //'carneEnvio' =>$this->carneEnvio,
            ))
          ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BufeteBundle\Entity\Personas',
            'carneEnvio'=> null,
            'nombreEnvio'=> null,
            'telefonoEnvio'=> null,
            'direccionEnvio'=> null,
            'correoEnvio'=> null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bufetebundle_personas';
    }


}
