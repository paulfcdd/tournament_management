<?php

namespace App\Controller\Section;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller
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