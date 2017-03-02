<?php

require_once "Controller.php";


class UsuariosController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaUsuarios = null;
        $id = null;
        $response = null;
        $code = null;

        //Obtener personaje en concreto
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }


        $listaUsuarios = UsuarioHandlerModel::getUsuario($id);

        //Ha encontrado el personaje
        if ($listaUsuarios != null) {
            $code = '200';

        //No lo ha encotrado
        } else {
            $code = '404';
        }

        $response = new Response($code, null, $listaUsuarios, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
    {
        $usuario = $request->getBodyParameters();

        $code='400';

        if($usuario->nick!=""&&$usuario->contrasena!=""&&$usuario->admin!=null)
            $code = UsuarioHandlerModel::postUsuario($usuario);

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $usuario = $request->getBodyParameters();

        $code='400';

        if($usuario->nick!=""&&$usuario->contrasena!=""&&$usuario->admin!=null)
            $code = UsuarioHandlerModel::putUsuario($usuario);

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

    public function manageDeleteVerb(Request $request)
    {

        $code = '400';

        if (isset($request->getUrlElements()[2])) {
            $code = UsuarioHandlerModel::deleteUsuario($request->getUrlElements()[2]);
        }

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

}