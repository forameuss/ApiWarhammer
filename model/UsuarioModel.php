<?php


class UsuarioModel implements JsonSerializable
{
    private $nick;
    private $contrasena;
    private $admin;

    public function __construct($nick,$contrasena,$admin)
    {
        $this->nick=$nick;
        $this->contrasena=$contrasena;
        $this->admin=$admin;
    }


    function jsonSerialize()
    {
        return array(
            'nick' => $this->nick,
            'contrasena' => $this->contrasena,
            'admin' => $this->admin
        );
    }


    public function __sleep(){
        return array('nick','contrasena','admin');
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return mixed
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * @param mixed $contrasena
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }



}