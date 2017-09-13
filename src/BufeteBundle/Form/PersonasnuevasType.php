<?php

namespace BufeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonasnuevasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombrePersona')
            ->add('telefonoPersona')
            ->add('direccionPersona')
            ->add('emailPersona')
            ->add('usuarioPersona')
            ->add('passPersona')
            ->add('estadoPersona',ChoiceType::class,array(
                "label" => "Estado",
                    "choices"=> array(
                        "ACTIVO" =>1,
                        "INACTIVO" =>2,
              ),
                'expanded'  => true,
                'multiple'  => false,
            ))
            //->add('role')
            ->add('role', ChoiceType::class,array(
                "label" => "Roles",
                    "choices"=> array(
                        "Administrador" =>"ROLE_ADMIN",
                        "Estudiante" =>"ROLE_ESTUDIANTE",
                        "Asesor" =>"ROLE_ASESOR",
                        "Secretario" =>"ROLE_SECRETARIO",
                        "Director" =>"ROLE_DIRECTO",
              ),
                'expanded'  => true,
                'multiple'  => false,
            ))
            ->add('idBufete')

          ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BufeteBundle\Entity\Personas',
        ));
    }

}
