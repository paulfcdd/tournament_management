<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
     * @Route(
     *     "/",
     *     name="app.index"
     * )
     */
    public function indexAction() {
        return $this->render('layouts/index.html.twig');
    }
}