<?php

namespace BufeteBundle\Entity;

/**
 * Clinicas
 */
class Clinicas
{
    /**
     * @var integer
     */
    private $idClinica;

    /**
     * @var \DateTime
     */
    private $fechaAsignacion;

    /**
     * @var \DateTime
     */
    private $fechaFin;

    /**
     * @var integer
     */
    private $estadoClinica;

    /**
     * @var \BufeteBundle\Entity\Tipocaso
     */
    private $idTipo;

    /**
     * @var \BufeteBundle\Entity\Estudiantes
     */
    private $idEstudiante;


    /**
     * Get idClinica
     *
     * @return integer
     */
    public function getIdClinica()
    {
        return $this->idClinica;
    }

    /**
     * Set fechaAsignacion
     *
     * @param \DateTime $fechaAsignacion
     *
     * @return Clinicas
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get fechaAsignacion
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Clinicas
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set estadoClinica
     *
     * @param integer $estadoClinica
     *
     * @return Clinicas
     */
    public function setEstadoClinica($estadoClinica)
    {
        $this->estadoClinica = $estadoClinica;

        return $this;
    }

    /**
     * Get estadoClinica
     *
     * @return integer
     */
    public function getEstadoClinica()
    {
        return $this->estadoClinica;
    }

    /**
     * Set idTipo
     *
     * @param \BufeteBundle\Entity\Tipocaso $idTipo
     *
     * @return Clinicas
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
     * Set idEstudiante
     *
     * @param \BufeteBundle\Entity\Estudiantes $idEstudiante
     *
     * @return Clinicas
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
}

