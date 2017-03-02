<?php

require_once "Constantes.php";
include($_SERVER['DOCUMENT_ROOT'].'/utils/Utils.php');


class UsuarioHandlerModel
{

    public static function getUsuario($nick)
    {
        //Utils::autenticarse();
        $listaUsuarios = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $query = "SELECT * FROM ". \ConstantesDB\Constantes::TABLA_USUARIOS;

            //Si el nick no es nulo se busca un personaje en concreto
            if ($nick != null) {
                $query = $query . " WHERE " . \ConstantesDB\Constantes::NICK . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            if ($nick != null) {
                $prep_query->bind_param('s', $nick);
            }

            $prep_query->execute();
            $listaUsuarios = array();


            $prep_query->bind_result($nick, $contrasena, $admin);
            while ($prep_query->fetch()) {
                $nick = utf8_encode($nick);
                $contrasena = utf8_encode($contrasena);

                $usuario = new UsuarioModel($nick, $contrasena, $admin);
                $listaUsuarios[] = $usuario;
            }


        $db_connection->close();

        return $listaUsuarios;
    }


    public static function postUsuario($listaUsuarios)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '404';

        if ($listaUsuarios != null) {
            if(count($listaUsuarios) > 1) {
                foreach ($listaUsuarios as $claves => $valor) {
                    $pass = password_hash($valor->contrasena, PASSWORD_DEFAULT);
                    $query = "INSERT INTO " . \ConstantesDB\Constantes::TABLA_USUARIOS . " VALUES ('" . $valor->nick . "','". $pass."' ," . $valor->admin. "); ";

                    if($db_connection->query($query))
                        $res= '200';
                }
            }
            else{
                $pass = password_hash($listaUsuarios->contrasena, PASSWORD_DEFAULT);
                $query = "INSERT INTO " . \ConstantesDB\Constantes::TABLA_USUARIOS . " VALUES ('" . $listaUsuarios->nick . "','". $pass ."' ," . $listaUsuarios->admin. "); ";

                if($db_connection->query($query))
                    $res= '200';
            }

        }

        $db_connection->close();

        return $res;
    }


    public static function putUsuario($usuario)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '500';

        if ($usuario != null) {
            $pass = password_hash($usuario->contrasena, PASSWORD_DEFAULT);
            $query = "UPDATE " . \ConstantesDB\Constantes::TABLA_USUARIOS . " SET ".\ConstantesDB\Constantes::CONTRASENA."='" . $pass . "', ".\ConstantesDB\Constantes::ADMIN."= " . $usuario->admin . " WHERE ". \ConstantesDB\Constantes::NICK." ='".$usuario->nick."'; ";

            if($db_connection->query($query))
                $res = '200';
        }


        $db_connection->close();

        return $res;
    }


    public static function deleteUsuario($nick)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '404';

        if ($nick != null){

            $query = "DELETE FROM " . \ConstantesDB\Constantes::TABLA_USUARIOS . " WHERE ".\ConstantesDB\Constantes::NICK." = '" . $nick . "';";

            if($db_connection->query($query))
                $res = '200';
            else
                $res = '500';

        }
        $db_connection->close();

        return $res;
    }

}