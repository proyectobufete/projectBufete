<?php

namespace BufeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EstudiantesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $this->carneEnvio = $options['carneEnvio'];

        $builder
            ->add('carneEstudiante',TextType::Class, array ("data"=>$this->carneEnvio))
            ->add('cierrePensum')
<<<<<<< HEAD
            ->add('estadoEstudiante')
=======
            ->add('estadoEstudiante', HiddenType::class, array(
    'data' => '1',))

>>>>>>> a2e4297dee3fadc0b15418edc23a1f61c29dca65
            //->add('idPersona')
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(

            'data_class' => 'BufeteBundle\Entity\Estudiantes',
            'carneEnvio'=> null,

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bufetebundle_estudiantes';
    }


}
