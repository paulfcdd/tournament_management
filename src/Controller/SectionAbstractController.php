<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class SectionAbstractController extends Controller implements SectionInterface
{
    public final function renderListPage(string $section, array $parameters = [])
    {
        $view = sprintf('section/%s/list.html.twig', $section);

        return $this->render($view, $parameters);
    }

    public final function renderManagePage(string $section){}
}