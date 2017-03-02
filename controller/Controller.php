<?php

class Controller
{

    public function manageGetVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePostVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePatchVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageDeleteVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageHeadVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageTraceVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageOptionsVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageConnectVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

}