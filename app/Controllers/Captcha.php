<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\Images\Image;

class Captcha extends Controller
{
    private function generateCaptchaText($length = 6)
    {
        // Genera un texto aleatorio utilizando letras y números
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captchaText = '';

        for ($i = 0; $i < $length; $i++) {
            $captchaText .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $captchaText;
    }
    public function captchaGD()
    {
	// Genera un texto aleatorio para el captcha
        $captchaText = $this->generateCaptchaText();

	$session = Services::session();
        // Guarda el texto del captcha en la sesión
        $session->set('captcha', $captchaText);
	
	$my_img = imagecreate( 100, 40 );
        $background = imagecolorallocate( $my_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        $text_colour = imagecolorallocate( $my_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagestring( $my_img, 4, 30, 15, $captchaText, $text_colour );
        imagesetthickness ( $my_img, 5 );
        header( "Content-type: image/png" );
        imagepng( $my_img );
        imagecolordeallocate( $text_color );
        imagecolordeallocate( $background );
        imagedestroy( $my_img );
    }
}
