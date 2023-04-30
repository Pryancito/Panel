<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;

class User extends BaseController
{
    public function __construct()
    {
        $this->http = \Config\Services::curlrequest();
    }
    
    public function login()
    {
        $request = request();
        $nickname = $request->getPost('nickname');
        $password = $request->getPost('password');

        if (!$nickname || !$password)
        {
            $data['error'] = "You must introduce nickname and/or password.";
            return view("error", $data);
        }
        $url = 'http://localhost:8000/auth?data=' . $nickname . "&" . $password; // URL de la web externa
        $respuesta = $this->http->get($url); // Hacer la consulta GET a la URL

        if ($respuesta->getStatusCode() == 200) { // Verificar si la respuesta es exitosa
            $datos = json_decode($respuesta->getBody(), true); // Convertir la respuesta JSON a un array asociativo
            if ($datos['status'] == "ERROR") {
                $data['error'] = $datos['message'];
                return view('error', $data);
            } else if ($datos['status'] == "OK") {
		$session = Services::session();
		$session->set('username', $nickname);
		$data['user'] = $nickname;
                return view('panel', $data);
            } else {
                $data['error'] = "Oops, there was an error.";
                return view('error', $data);
            }
        } else {
            $data['error'] = "Oops, there was an error.";
            return view('error', $data);
        }
    }
    
    public function register()
    {
        return view("register");
    }
    public function do_register()
    {
	$request = request();
        $nickname = $request->getPost('nickname');
        $password = $request->getPost('password');
	$captcha = $request->getPost('captcha');
	$session = Services::session();
        // Guarda el texto del captcha en la sesión
        $sessionCaptcha = $session->get('captcha');

        if (!$nickname || !$password)
        {
            $data['error'] = "You must introduce nickname and/or password.";
            return view("error", $data);
        }
	if ($captcha != $sessionCaptcha)
	{
	    $data['error'] = "Invalid Captcha code.";
            return view("error", $data);
        }
        $url = 'http://localhost:8000/register?data=' . $nickname . "&" . $password; // URL de la web externa
        $respuesta = $this->http->get($url); // Hacer la consulta GET a la URL

        if ($respuesta->getStatusCode() == 200) { // Verificar si la respuesta es exitosa
            $datos = json_decode($respuesta->getBody(), true); // Convertir la respuesta JSON a un array asoci>
            if ($datos['status'] == "ERROR") {
                $data['error'] = $datos['message'];
                return view('error', $data);
            } else if ($datos['status'] == "OK") {
		$session->set('username', $nickname);
                $data['user'] = $nickname;
                return view('panel', $data);
            } else {
                $data['error'] = "Oops, there was an error.";
                return view('error', $data);
            }
        } else {
            $data['error'] = "Oops, there was an error.";
            return view('error', $data);
        }
    }
    public function logout()
    {
	$session = Services::session();
	$session->destroy();
	return view('home');
    }
}
