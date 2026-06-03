<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Pwa extends Controller
{
    public function manifest()
    {
        return $this->response->setContentType('application/json')
            ->setBody(file_get_contents(public_path('manifest.webmanifest')));
    }

    public function serviceWorker()
    {
        return $this->response->setContentType('application/javascript')
            ->setBody(file_get_contents(public_path('service-worker.js')));
    }
}