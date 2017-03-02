<?php

class Utils
{

    public static function autenticarse(){
        list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="Mi dominio"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'ERROR: se necesita estar logueado para acceder a este sitio.';
            exit;
        } else {
            echo "<p>Hola {$_SERVER['PHP_AUTH_USER']}.</p>";
            echo "<p>Introdujo {$_SERVER['PHP_AUTH_PW']} como su contraseña.</p>";
        }
    }
}