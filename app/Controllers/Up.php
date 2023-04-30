<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

class Up extends BaseController
{
    public function upload()
    {
        $validationRule = [
            'archivo' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[archivo]',
                    'is_image[archivo]',
                    'mime_in[archivo,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[archivo,1000]',
                    //'max_dims[archivo,1024,768]',
                ],
            ],
        ];

        if (! $this->validate($validationRule)) {
            $data['error'] = "The filename is not valid.";

            return view('upload', $data);
        }

        $img = $this->request->getFile('archivo');

        if (! $img->hasMoved()) {
            $newName = "moebius";
            $destination = WRITEPATH . 'avatar/' . $newName;
            if (is_file($destination)) {
                unlink($destination); // Eliminar archivo existente
            }

            $img->move(WRITEPATH . 'avatar', $newName, true);
            $data['error'] = "";
            return view('upload', $data);
        }

        $data['error'] = 'The file has already been moved.';

        return view('upload', $data);
    }
    
    public function form()
    {
        $data['error'] = "";
        return view("upload", $data);
    }
    
    public function view($nickname)
    {
        $destination = WRITEPATH . 'avatar/' . $nickname;
        if (is_file($destination))
        {
            $tipoContenido = mime_content_type($destination);
            $imagen = file_get_contents($destination);

            return $this->response
                ->setContentType($tipoContenido)
                ->setBody($imagen)
                ->setHeader('Content-Length', strlen($imagen));
        } else {
            $destination = WRITEPATH . 'uploads/template';
            $tipoContenido = mime_content_type($destination);
            $imagen = file_get_contents($destination);

            return $this->response
                ->setContentType($tipoContenido)
                ->setBody($imagen)
                ->setHeader('Content-Length', strlen($imagen));
        }
    }
}
