<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\AbstractEntity;
use App\Entity\Country;
use App\Form\CountryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CountriesController extends SectionAbstractController
{
    /**
     * @Route("/countries", name="app.country")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderListPageAction()
    {
        return parent::renderPage('country', 'list', []);
    }

    /**
     * @Route("/country/manage/{id}", name="app.country.manage", defaults={"id"=null})
     * @ParamConverter("id", class="App:Country")
     * @param AbstractEntity | Country | null $id
     * @return mixed
     */
    public function renderManagePageAction(AbstractEntity $id = null)
    {
        $formLabel = $id ? sprintf('Edit country %s', $id->getName()) : 'Add new country';
        $formType = CountryType::class;
        $formData = $id;
        $formOptions = [
            'action' => $this->generateUrl('app.country.save-data', [
                'id' => $id ? $id->getId() : null
            ])
        ];

        return parent::renderPage('country', 'manage', [
            'formLabel' => $formLabel,
            'form' => parent::getForm($formType, $formData, $formOptions)

        ]);
    }

    /**
     * @Route("/country/save-data/{id}", name="app.country.save-data", defaults={"id"=null})
     * @Method("POST")
     * @ParamConverter("id", class="App:Country")
     * @param Request $request
     * @param AbstractEntity|null $id
     * @return mixed|string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAction(Request $request, AbstractEntity $id = null)
    {
        $formType = CountryType::class;

        return parent::saveDataAndRedirect($formType, $request, 'app.country.manage', $id);
    }
}