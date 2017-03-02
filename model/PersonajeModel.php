<?php


class PersonajeModel implements JsonSerializable
{
    private $id;
    private $nombre;
    private $faccion;

    public function __construct($id,$nombre,$faccion)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->faccion=$faccion;
    }


    function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'faccion' => $this->faccion
        );
    }


    public function __sleep(){
        return array('id','nombre','faccion');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getFaccion()
    {
        return $this->faccion;
    }

    /**
     * @param mixed $faccion
     */
    public function setFaccion($faccion)
    {
        $this->faccion = $faccion;
    }

}