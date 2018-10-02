<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\Country;
use Symfony\Component\Routing\Annotation\Route;

class CountriesController extends SectionAbstractController
{
    /**
     * @Route("/countries", name="app.country")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderListPageAction()
    {
        return parent::renderListPage('country', []);
    }

    /**
     * @Route("/countries/manage/{id}", name="app.country.manage")
     */
    public function renderManagePageAction($id)
    {
        dump('test');
        die;
    }
}