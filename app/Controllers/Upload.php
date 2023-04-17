<?php

namespace App\Controllers;

class Upload extends BaseController
{
    public function index()
    {
        $this->load->library('upload');
        $config['upload_path'] = './avatar/'; // Directorio de destino
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Extensiones permitidas
        $config['max_size'] = '1024'; // Tamaño máximo en KB
        $config['encrypt_name'] = false; // Nombre del archivo encriptado
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('archivo')) {
            return view("upload-success");
        } else {
            $error = $this->upload->display_errors();
            $data["error"] = $error;
            return view("upload-failed", $data);
        }

    }
}
