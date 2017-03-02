<?php

require_once "Constantes.php";
include($_SERVER['DOCUMENT_ROOT'].'/utils/Utils.php');


class PersonajeHandlerModel
{

    public static function getPersonaje($id)
    {
        $listaPersonajes = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $query = "SELECT * FROM ". \ConstantesDB\Constantes::TABLA_PERSONAJES;

            //Si el Id no es nulo se busca un personaje en concreto
            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\Constantes::ID . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaPersonajes = array();


            $prep_query->bind_result($id, $nombre, $faccion);
            while ($prep_query->fetch()) {
                $nombre = utf8_encode($nombre);
                $faccion = utf8_encode($faccion);
                $personaje = new PersonajeModel($id, $nombre, $faccion);
                $listaPersonajes[] = $personaje;
            }


        $db_connection->close();

        return $listaPersonajes;
    }


    public static function postPersonaje($listaPersonajes)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '404';

        if ($listaPersonajes != null) {
            if(count($listaPersonajes) > 1) {
                foreach ($listaPersonajes as $claves => $valor) {
                    $query = "INSERT INTO " . \ConstantesDB\Constantes::TABLA_PERSONAJES . " VALUES (NULL, '" . $valor->nombre . "','". $valor->faccion."' ); ";

                    if($db_connection->query($query))
                        $res= '200';
                }
            }
            else{
                $query = "INSERT INTO " . \ConstantesDB\Constantes::TABLA_PERSONAJES . " VALUES (NULL, '" . $listaPersonajes->nombre . "','". $listaPersonajes->faccion."' ); ";

                if($db_connection->query($query))
                    $res= '200';
            }

        }

        $db_connection->close();

        return $res;
    }


    public static function putPersonaje($personaje)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '500';

        if ($personaje != null) {

            $query = "UPDATE " . \ConstantesDB\Constantes::TABLA_PERSONAJES . " SET ".\ConstantesDB\Constantes::NOMBRE."='" . $personaje->nombre . "', ".\ConstantesDB\Constantes::FACCION."= '" . $personaje->faccion . "' WHERE ". \ConstantesDB\Constantes::ID." =".$personaje->id."; ";

            if($db_connection->query($query))
                $res = '200';
        }


        $db_connection->close();

        return $res;
    }


    public static function deletePersonaje($id)
    {
        //Utils::autenticarse();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $res = '404';

        if ($id != null){

            $query = "DELETE FROM " . \ConstantesDB\Constantes::TABLA_PERSONAJES . " WHERE ".\ConstantesDB\Constantes::ID." = " . $id . ";";

            if($db_connection->query($query))
                $res = '200';
            else
                $res = '500';

        }
        $db_connection->close();

        return $res;
    }

}