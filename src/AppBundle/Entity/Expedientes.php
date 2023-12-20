<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * Expedientes
 *
 * @ORM\Table(name="expedientes", indexes={@ORM\Index(name="Ref2632", columns={"usuario_id"}), @ORM\Index(name="Ref1935", columns={"estadoexpedienteinstancia_id"}), @ORM\Index(name="Ref166", columns={"seccion_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedientesRepository")
 */
class Expedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="expedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroexpediente", type="integer", nullable=false)
     */
    private $numeroexpediente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaentrada", type="datetime", nullable=false)
     */
    private $fechaentrada = 'now()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapagado", type="datetime", nullable=true)
     */
    private $fechapagado;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficiario", type="string", length=255, nullable=false)
     */
    private $beneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="importesolicitado", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $importesolicitado;

    /**
     * @var string
     *
     * @ORM\Column(name="importepagado", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $importepagado;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="string", length=255, nullable=true)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pagodirecto", type="boolean", nullable=false)
     */
    private $pagodirecto = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mandamientopago", type="boolean", nullable=false)
     */
    private $mandamientopago = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prioridad", type="boolean", nullable=false)
     */
    private $prioridad = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defectuoso", type="boolean", nullable=false)
     */
    private $defectuoso = false;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacionarchivo", type="string", length=255, nullable=true)
     */
    private $ubicacionarchivo;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Estadosexpedientesinstancias
     *
     * @ORM\ManyToOne(targetEntity="Estadosexpedientesinstancias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadoexpedienteinstancia_id", referencedColumnName="id")
     * })
     */
    private $estadoexpedienteinstancia;

    /**
     * @var \Secciones
     *
     * @ORM\ManyToOne(targetEntity="Secciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seccion_id", referencedColumnName="id")
     * })
     */
    private $seccion;

    /**
     * @ORM\OneToMany(targetEntity="Registrosexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $registros;

    /**
     * @ORM\OneToMany(targetEntity="Presupuestosserviciosexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $partidas;

    /**
     * @ORM\OneToMany(targetEntity="Historicosestadosexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $historicosEstados;


    /**
     * @ORM\OneToMany(targetEntity="Parametrizacionexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $parametrizaciones;

    /**
     * @ORM\OneToMany(targetEntity="Mandamientospagosexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $mandamientosPagos;

    /**
     * @ORM\OneToMany(targetEntity="Evidenciasexpedientes", mappedBy="expediente" , cascade={"remove"})
     * @OrderBy({"id" = "ASC"})
     */
    private $evidenciasExpedientes;


    /**
     * Expedientes constructor.
     */
    public function __construct()
    {
        $this->registros  = new ArrayCollection();
        $this->partidas = new ArrayCollection();
        $this->historicosEstados = new ArrayCollection();
        $this->parametrizaciones = new ArrayCollection();
        $this->mandamientosPagos = new ArrayCollection();
        $this->evidenciasExpedientes = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numeroexpediente
     *
     * @param integer $numeroexpediente
     *
     * @return Expedientes
     */
    public function setNumeroexpediente($numeroexpediente)
    {
        $this->numeroexpediente = $numeroexpediente;

        return $this;
    }

    /**
     * Get numeroexpediente
     *
     * @return integer
     */
    public function getNumeroexpediente()
    {
        return $this->numeroexpediente;
    }

    public function getNumeroExpedienteMostrar()
    {
        $year = $this->fechaentrada->format('Y');

        return $year.' - '.$this->getNumeroexpediente();
    }

    /**
     * Set fechaentrada
     *
     * @param \DateTime $fechaentrada
     *
     * @return Expedientes
     */
    public function setFechaentrada($fechaentrada)
    {
        $this->fechaentrada = $fechaentrada;

        return $this;
    }

    /**
     * Get fechaentrada
     *
     * @return \DateTime
     */
    public function getFechaentrada()
    {
        return $this->fechaentrada;
    }

    /**
     * Set fechapagado
     *
     * @param \DateTime $fechapagado
     *
     * @return Expedientes
     */
    public function setFechapagado($fechapagado)
    {
        $this->fechapagado = $fechapagado;

        return $this;
    }

    /**
     * Get fechapagado
     *
     * @return \DateTime
     */
    public function getFechapagado()
    {
        return $this->fechapagado;
    }

    /**
     * Set beneficiario
     *
     * @param string $beneficiario
     *
     * @return Expedientes
     */
    public function setBeneficiario($beneficiario)
    {
        $this->beneficiario = $beneficiario;

        return $this;
    }

    /**
     * Get beneficiario
     *
     * @return string
     */
    public function getBeneficiario()
    {
        return $this->beneficiario;
    }

    /**
     * Set importesolicitado
     *
     * @param string $importesolicitado
     *
     * @return Expedientes
     */
    public function setImportesolicitado($importesolicitado)
    {
        $this->importesolicitado = $importesolicitado;

        return $this;
    }

    /**
     * Get importesolicitado
     *
     * @return string
     */
    public function getImportesolicitado()
    {
        return $this->importesolicitado;
    }

    /**
     * Set importepagado
     *
     * @param string $importepagado
     *
     * @return Expedientes
     */
    public function setImportepagado($importepagado)
    {
        $this->importepagado = $importepagado;

        return $this;
    }

    /**
     * Get importepagado
     *
     * @return string
     */
    public function getImportepagado()
    {
        return $this->importepagado;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     *
     * @return Expedientes
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Expedientes
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set pagodirecto
     *
     * @param boolean $pagodirecto
     *
     * @return Expedientes
     */
    public function setPagodirecto($pagodirecto)
    {
        $this->pagodirecto = $pagodirecto;

        return $this;
    }

    /**
     * Get pagodirecto
     *
     * @return boolean
     */
    public function getPagodirecto()
    {
        return $this->pagodirecto;
    }

    /**
     * Set mandamientopago
     *
     * @param boolean $mandamientopago
     *
     * @return Expedientes
     */
    public function setMandamientopago($mandamientopago)
    {
        $this->mandamientopago = $mandamientopago;

        return $this;
    }

    /**
     * Get mandamientopago
     *
     * @return boolean
     */
    public function getMandamientopago()
    {
        return $this->mandamientopago;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Expedientes
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set prioridad
     *
     * @param boolean $prioridad
     *
     * @return Expedientes
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return boolean
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set defectuoso
     *
     * @param boolean $defectuoso
     *
     * @return Expedientes
     */
    public function setDefectuoso($defectuoso)
    {
        $this->defectuoso = $defectuoso;

        return $this;
    }

    /**
     * Get defectuoso
     *
     * @return boolean
     */
    public function getDefectuoso()
    {
        return $this->defectuoso;
    }

    /**
     * Set ubicacionarchivo
     *
     * @param string $ubicacionarchivo
     *
     * @return Expedientes
     */
    public function setUbicacionarchivo($ubicacionarchivo)
    {
        $this->ubicacionarchivo = $ubicacionarchivo;

        return $this;
    }

    /**
     * Get ubicacionarchivo
     *
     * @return string
     */
    public function getUbicacionarchivo()
    {
        return $this->ubicacionarchivo;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Expedientes
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set estadoexpedienteinstancia
     *
     * @param \AppBundle\Entity\Estadosexpedientesinstancias $estadoexpedienteinstancia
     *
     * @return Expedientes
     */
    public function setEstadoexpedienteinstancia(\AppBundle\Entity\Estadosexpedientesinstancias $estadoexpedienteinstancia = null)
    {
        $this->estadoexpedienteinstancia = $estadoexpedienteinstancia;

        return $this;
    }

    /**
     * Get estadoexpedienteinstancia
     *
     * @return \AppBundle\Entity\Estadosexpedientesinstancias
     */
    public function getEstadoexpedienteinstancia()
    {
        return $this->estadoexpedienteinstancia;
    }

    /**
     * Set seccion
     *
     * @param \AppBundle\Entity\Secciones $seccion
     *
     * @return Expedientes
     */
    public function setSeccion(\AppBundle\Entity\Secciones $seccion = null)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return \AppBundle\Entity\Secciones
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Add registro
     *
     * @param \AppBundle\Entity\Registrosexpedientes $registro
     *
     * @return Expedientes
     */
    public function addRegistro(\AppBundle\Entity\Registrosexpedientes $registro)
    {
        $this->registros[] = $registro;

        return $this;
    }

    /**
     * Remove registro
     *
     * @param \AppBundle\Entity\Registrosexpedientes $registro
     */
    public function removeRegistro(\AppBundle\Entity\Registrosexpedientes $registro)
    {
        $this->registros->removeElement($registro);
    }

    /**
     * Get registros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegistros()
    {
        return $this->registros;
    }

    /**
     * Add partida
     *
     * @param \AppBundle\Entity\Presupuestosserviciosexpedientes $partida
     *
     * @return Expedientes
     */
    public function addPartida(\AppBundle\Entity\Presupuestosserviciosexpedientes $partida)
    {
        $this->partidas[] = $partida;

        return $this;
    }

    /**
     * Remove partida
     *
     * @param \AppBundle\Entity\Presupuestosserviciosexpedientes $partida
     */
    public function removePartida(\AppBundle\Entity\Presupuestosserviciosexpedientes $partida)
    {
        $this->partidas->removeElement($partida);
    }

    /**
     * Get partidas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartidas()
    {
        return $this->partidas;
    }


    /**
     * Add historicosEstado
     *
     * @param \AppBundle\Entity\Historicosestadosexpedientes $historicosEstado
     *
     * @return Expedientes
     */
    public function addHistoricosEstado(\AppBundle\Entity\Historicosestadosexpedientes $historicosEstado)
    {
        $this->historicosEstados[] = $historicosEstado;

        return $this;
    }

    /**
     * Remove historicosEstado
     *
     * @param \AppBundle\Entity\Historicosestadosexpedientes $historicosEstado
     */
    public function removeHistoricosEstado(\AppBundle\Entity\Historicosestadosexpedientes $historicosEstado)
    {
        $this->historicosEstados->removeElement($historicosEstado);
    }

    /**
     * Get historicosEstados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoricosEstados()
    {
        return $this->historicosEstados;
    }

    /**
     * Add parametrizacione
     *
     * @param \AppBundle\Entity\Parametrizacionexpedientes $parametrizacione
     *
     * @return Expedientes
     */
    public function addParametrizacione(\AppBundle\Entity\Parametrizacionexpedientes $parametrizacione)
    {
        $this->parametrizaciones[] = $parametrizacione;

        return $this;
    }

    /**
     * Remove parametrizacione
     *
     * @param \AppBundle\Entity\Parametrizacionexpedientes $parametrizacione
     */
    public function removeParametrizacione(\AppBundle\Entity\Parametrizacionexpedientes $parametrizacione)
    {
        $this->parametrizaciones->removeElement($parametrizacione);
    }

    /**
     * Get parametrizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParametrizaciones()
    {
        return $this->parametrizaciones;
    }


    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Expedientes
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Add mandamientosPago
     *
     * @param \AppBundle\Entity\Mandamientospagosexpedientes $mandamientosPago
     *
     * @return Expedientes
     */
    public function addMandamientosPago(\AppBundle\Entity\Mandamientospagosexpedientes $mandamientosPago)
    {
        $this->mandamientosPagos[] = $mandamientosPago;

        return $this;
    }

    /**
     * Remove mandamientosPago
     *
     * @param \AppBundle\Entity\Mandamientospagosexpedientes $mandamientosPago
     */
    public function removeMandamientosPago(\AppBundle\Entity\Mandamientospagosexpedientes $mandamientosPago)
    {
        $this->mandamientosPagos->removeElement($mandamientosPago);
    }

    /**
     * Get mandamientosPagos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMandamientosPagos()
    {
        return $this->mandamientosPagos;
    }

    /**
     * Add evidenciasExpediente
     *
     * @param \AppBundle\Entity\Evidenciasexpedientes $evidenciasExpediente
     *
     * @return Expedientes
     */
    public function addEvidenciasExpediente(\AppBundle\Entity\Evidenciasexpedientes $evidenciasExpediente)
    {
        $this->evidenciasExpedientes[] = $evidenciasExpediente;

        return $this;
    }

    /**
     * Remove evidenciasExpediente
     *
     * @param \AppBundle\Entity\Evidenciasexpedientes $evidenciasExpediente
     */
    public function removeEvidenciasExpediente(\AppBundle\Entity\Evidenciasexpedientes $evidenciasExpediente)
    {
        $this->evidenciasExpedientes->removeElement($evidenciasExpediente);
    }

    /**
     * Get evidenciasExpedientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvidenciasExpedientes()
    {
        return $this->evidenciasExpedientes;
    }
}
