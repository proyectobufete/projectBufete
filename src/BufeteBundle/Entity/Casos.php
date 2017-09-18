<?php

namespace BufeteBundle\Entity;

/**
 * Casos
 */
class Casos
{

    protected $laborales;

    protected $civiles;

    /**
     * @var integer
     */
    private $idCaso;

    /**
     * @var integer
     */
    private $noCaso;

    /**
     * @var \DateTime
     */
    private $fechaCaso;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $pruebasCaso;

    /**
     * @var integer
     */
    private $asignatarioCaso;

    /**
     * @var integer
     */
    private $estadoCaso;

    /**
     * @var string
     */
    private $nombreDemandado;

    /**
     * @var string
     */
    private $dirDemandado;

    /**
     * @var string
     */
    private $dirnotificacionDemandado;

    /**
     * @var integer
     */
    private $telefonoDemandado;

    /**
     * @var string
     */
    private $otroDemandado;

    /**
     * @var \BufeteBundle\Entity\Demandantes
     */
    private $idDemandante;

    /**
     * @var \BufeteBundle\Entity\Estudiantes
     */
    private $idEstudiante;

    /**
     * @var \BufeteBundle\Entity\Tribunales
     */
    private $idTribunal;

    /**
     * @var \BufeteBundle\Entity\Personas
     */
    private $idPersona;

    /**
     * @var \BufeteBundle\Entity\Tipocaso
     */
    private $idTipo;


    /**
     * Get idCaso
     *
     * @return integer
     */
    public function getIdCaso()
    {
        return $this->idCaso;
    }

    /**
     * Set noCaso
     *
     * @param integer $noCaso
     *
     * @return Casos
     */
    public function setNoCaso($noCaso)
    {
        $this->noCaso = $noCaso;

        return $this;
    }

    /**
     * Get noCaso
     *
     * @return integer
     */
    public function getNoCaso()
    {
        return $this->noCaso;
    }

    /**
     * Set fechaCaso
     *
     * @param \DateTime $fechaCaso
     *
     * @return Casos
     */
    public function setFechaCaso($fechaCaso)
    {
        $this->fechaCaso = $fechaCaso;

        return $this;
    }

    /**
     * Get fechaCaso
     *
     * @return \DateTime
     */
    public function getFechaCaso()
    {
        return $this->fechaCaso;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return Casos
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set pruebasCaso
     *
     * @param string $pruebasCaso
     *
     * @return Casos
     */
    public function setPruebasCaso($pruebasCaso)
    {
        $this->pruebasCaso = $pruebasCaso;

        return $this;
    }

    /**
     * Get pruebasCaso
     *
     * @return string
     */
    public function getPruebasCaso()
    {
        return $this->pruebasCaso;
    }

    /**
     * Set asignatarioCaso
     *
     * @param integer $asignatarioCaso
     *
     * @return Casos
     */
    public function setAsignatarioCaso($asignatarioCaso)
    {
        $this->asignatarioCaso = $asignatarioCaso;

        return $this;
    }

    /**
     * Get asignatarioCaso
     *
     * @return integer
     */
    public function getAsignatarioCaso()
    {
        return $this->asignatarioCaso;
    }

    /**
     * Set estadoCaso
     *
     * @param integer $estadoCaso
     *
     * @return Casos
     */
    public function setEstadoCaso($estadoCaso)
    {
        $this->estadoCaso = $estadoCaso;

        return $this;
    }

    /**
     * Get estadoCaso
     *
     * @return integer
     */
    public function getEstadoCaso()
    {
        return $this->estadoCaso;
    }

    /**
     * Set nombreDemandado
     *
     * @param string $nombreDemandado
     *
     * @return Casos
     */
    public function setNombreDemandado($nombreDemandado)
    {
        $this->nombreDemandado = $nombreDemandado;

        return $this;
    }

    /**
     * Get nombreDemandado
     *
     * @return string
     */
    public function getNombreDemandado()
    {
        return $this->nombreDemandado;
    }

    /**
     * Set dirDemandado
     *
     * @param string $dirDemandado
     *
     * @return Casos
     */
    public function setDirDemandado($dirDemandado)
    {
        $this->dirDemandado = $dirDemandado;

        return $this;
    }

    /**
     * Get dirDemandado
     *
     * @return string
     */
    public function getDirDemandado()
    {
        return $this->dirDemandado;
    }

    /**
     * Set dirnotificacionDemandado
     *
     * @param string $dirnotificacionDemandado
     *
     * @return Casos
     */
    public function setDirnotificacionDemandado($dirnotificacionDemandado)
    {
        $this->dirnotificacionDemandado = $dirnotificacionDemandado;

        return $this;
    }



public function __toString()
{
return $this->asunto;
}

    /**
     * Get dirnotificacionDemandado
     *
     * @return string
     */
    public function getDirnotificacionDemandado()
    {
        return $this->dirnotificacionDemandado;
    }

    /**
     * Set telefonoDemandado
     *
     * @param integer $telefonoDemandado
     *
     * @return Casos
     */
    public function setTelefonoDemandado($telefonoDemandado)
    {
        $this->telefonoDemandado = $telefonoDemandado;

        return $this;
    }

    /**
     * Get telefonoDemandado
     *
     * @return integer
     */
    public function getTelefonoDemandado()
    {
        return $this->telefonoDemandado;
    }

    /**
     * Set otroDemandado
     *
     * @param string $otroDemandado
     *
     * @return Casos
     */
    public function setOtroDemandado($otroDemandado)
    {
        $this->otroDemandado = $otroDemandado;

        return $this;
    }

    /**
     * Get otroDemandado
     *
     * @return string
     */
    public function getOtroDemandado()
    {
        return $this->otroDemandado;
    }

    /**
     * Set idDemandante
     *
     * @param \BufeteBundle\Entity\Demandantes $idDemandante
     *
     * @return Casos
     */
    public function setIdDemandante(\BufeteBundle\Entity\Demandantes $idDemandante = null)
    {
        $this->idDemandante = $idDemandante;

        return $this;
    }

    /**
     * Get idDemandante
     *
     * @return \BufeteBundle\Entity\Demandantes
     */
    public function getIdDemandante()
    {
        return $this->idDemandante;
    }

    /**
     * Set idEstudiante
     *
     * @param \BufeteBundle\Entity\Estudiantes $idEstudiante
     *
     * @return Casos
     */
    public function setIdEstudiante(\BufeteBundle\Entity\Estudiantes $idEstudiante = null)
    {
        $this->idEstudiante = $idEstudiante;

        return $this;
    }

    /**
     * Get idEstudiante
     *
     * @return \BufeteBundle\Entity\Estudiantes
     */
    public function getIdEstudiante()
    {
        return $this->idEstudiante;
    }

    /**
     * Set idTribunal
     *
     * @param \BufeteBundle\Entity\Tribunales $idTribunal
     *
     * @return Casos
     */
    public function setIdTribunal(\BufeteBundle\Entity\Tribunales $idTribunal = null)
    {
        $this->idTribunal = $idTribunal;

        return $this;
    }

    /**
     * Get idTribunal
     *
     * @return \BufeteBundle\Entity\Tribunales
     */
    public function getIdTribunal()
    {
        return $this->idTribunal;
    }

    /**
     * Set idPersona
     *
     * @param \BufeteBundle\Entity\Personas $idPersona
     *
     * @return Casos
     */
    public function setIdPersona(\BufeteBundle\Entity\Personas $idPersona = null)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \BufeteBundle\Entity\Personas
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set idTipo
     *
     * @param \BufeteBundle\Entity\Tipocaso $idTipo
     *
     * @return Casos
     */
    public function setIdTipo(\BufeteBundle\Entity\Tipocaso $idTipo = null)
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get idTipo
     *
     * @return \BufeteBundle\Entity\Tipocaso
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
    * Set Laborales
    *
    * @param \AppBundle\Entity\Laborales $laborales
    * @return Casos
    */
    public function setLaborales(\BufeteBundle\Entity\Laborales $laborales = null)
    {
      $this->laborales = $laborales;
      $laborales->setIdCaso($this);
      return $this;
    }

    /**
    * Get laborales
    *
    * @return \AppBundle\Entity\Laborales
    */
    public function getLaborales()
    {
      return $this->laborales;
    }


    /**
    * Set Civiles
    *
    * @param \AppBundle\Entity\Civiles $civiles
    * @return Casos
    */
    public function setCiviles(\BufeteBundle\Entity\Civiles $civiles = null)
    {
      $this->civiles = $civiles;
      $civiles->setIdCaso($this);
      return $this;
    }

    /**
    * Get civiles
    *
    * @return \AppBundle\Entity\Civiles
    */
    public function getCiviles()
    {
      return $this->civiles;
    }
}
