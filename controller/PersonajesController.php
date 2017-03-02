<?php

require_once "Controller.php";


class PersonajesController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaPersonajes = null;
        $id = null;
        $response = null;
        $code = null;

        //Obtener personaje en concreto
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }


        $listaPersonajes = PersonajeHandlerModel::getPersonaje($id);

        //Ha encontrado el personaje
        if ($listaPersonajes != null) {
            $code = '200';

        //No lo ha encotrado
        } else {
            $code = '404';
        }

        $response = new Response($code, null, $listaPersonajes, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
    {
        $personaje = $request->getBodyParameters();

        $code='400';

        if($personaje->nombre!=""&&$personaje->faccion!="")
            $code = PersonajeHandlerModel::postPersonaje($personaje);

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $personaje = $request->getBodyParameters();

        $code='400';

        if($personaje->nombre!=""&&$personaje->faccion!=""&&$personaje->id!=null)
            $code = PersonajeHandlerModel::putPersonaje($personaje);

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

    public function manageDeleteVerb(Request $request)
    {

        $code = '400';

        if (isset($request->getUrlElements()[2])) {
            $code = PersonajeHandlerModel::deletePersonaje($request->getUrlElements()[2]);
        }

        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

}