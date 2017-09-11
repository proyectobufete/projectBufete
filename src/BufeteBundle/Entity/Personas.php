<?php

namespace BufeteBundle\Entity;

/**
 * Personas
 */
class Personas
{
    /**
     * @var integer
     */
    private $idPersona;

    /**
     * @var string
     */
    private $nombrePersona;

    /**
     * @var integer
     */
    private $telefonoPersona;

    /**
     * @var string
     */
    private $direccionPersona;

    /**
     * @var string
     */
    private $emailPersona;

    /**
     * @var string
     */
    private $usuarioPersona;

    /**
     * @var string
     */
    private $passPersona;

    /**
     * @var boolean
     */
    private $estadoPersona;

    /**
     * @var string
     */
    private $role;

    /**
     * @var \BufeteBundle\Entity\Bufetes
     */
    private $idBufete;


    /**
     * Get idPersona
     *
     * @return integer
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }



      public function __toString()
       {
         return $this->nombrePersona;
       }
       
    /**
     * Set nombrePersona
     *
     * @param string $nombrePersona
     *
     * @return Personas
     */
    public function setNombrePersona($nombrePersona)
    {
        $this->nombrePersona = $nombrePersona;

        return $this;
    }

    /**
     * Get nombrePersona
     *
     * @return string
     */
    public function getNombrePersona()
    {
        return $this->nombrePersona;
    }

    /**
     * Set telefonoPersona
     *
     * @param integer $telefonoPersona
     *
     * @return Personas
     */
    public function setTelefonoPersona($telefonoPersona)
    {
        $this->telefonoPersona = $telefonoPersona;

        return $this;
    }

    /**
     * Get telefonoPersona
     *
     * @return integer
     */
    public function getTelefonoPersona()
    {
        return $this->telefonoPersona;
    }

    /**
     * Set direccionPersona
     *
     * @param string $direccionPersona
     *
     * @return Personas
     */
    public function setDireccionPersona($direccionPersona)
    {
        $this->direccionPersona = $direccionPersona;

        return $this;
    }

    /**
     * Get direccionPersona
     *
     * @return string
     */
    public function getDireccionPersona()
    {
        return $this->direccionPersona;
    }

    /**
     * Set emailPersona
     *
     * @param string $emailPersona
     *
     * @return Personas
     */
    public function setEmailPersona($emailPersona)
    {
        $this->emailPersona = $emailPersona;

        return $this;
    }

    /**
     * Get emailPersona
     *
     * @return string
     */
    public function getEmailPersona()
    {
        return $this->emailPersona;
    }

    /**
     * Set usuarioPersona
     *
     * @param string $usuarioPersona
     *
     * @return Personas
     */
    public function setUsuarioPersona($usuarioPersona)
    {
        $this->usuarioPersona = $usuarioPersona;

        return $this;
    }

    /**
     * Get usuarioPersona
     *
     * @return string
     */
    public function getUsuarioPersona()
    {
        return $this->usuarioPersona;
    }

    /**
     * Set passPersona
     *
     * @param string $passPersona
     *
     * @return Personas
     */
    public function setPassPersona($passPersona)
    {
        $this->passPersona = $passPersona;

        return $this;
    }

    /**
     * Get passPersona
     *
     * @return string
     */
    public function getPassPersona()
    {
        return $this->passPersona;
    }

    /**
     * Set estadoPersona
     *
     * @param boolean $estadoPersona
     *
     * @return Personas
     */
    public function setEstadoPersona($estadoPersona)
    {
        $this->estadoPersona = $estadoPersona;

        return $this;
    }

    /**
     * Get estadoPersona
     *
     * @return boolean
     */
    public function getEstadoPersona()
    {
        return $this->estadoPersona;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Personas
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set idBufete
     *
     * @param \BufeteBundle\Entity\Bufetes $idBufete
     *
     * @return Personas
     */
    public function setIdBufete(\BufeteBundle\Entity\Bufetes $idBufete = null)
    {
        $this->idBufete = $idBufete;

        return $this;
    }

    /**
     * Get idBufete
     *
     * @return \BufeteBundle\Entity\Bufetes
     */
    public function getIdBufete()
    {
        return $this->idBufete;
    }
}
