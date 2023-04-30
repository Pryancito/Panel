<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;

class Panel extends BaseController
{
    public function __construct()
    {
	parent::__construct();
	$session = Services::session();

	// Comprobar si la variable de sesión "mi_variable" existe
	if (!$session->has('username')) {
	    $data['error'] = "Access denied.
	    return view('error', $data);
	}
	$this->http = \Config\Services::curlrequest();
    }
}
