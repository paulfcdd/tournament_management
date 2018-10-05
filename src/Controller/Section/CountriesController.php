<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\AbstractEntity;
use App\Entity\Country;
use App\Entity\League;
use App\Form\CountryType;
use App\Form\LeagueType;
use Doctrine\ORM\EntityManagerInterface;
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
        return parent::renderPage('country', 'list', [
            'countries' => parent::getAllFromDb(Country::class)
        ]);
    }

    /**
     * @Route("/country/manage/{object}", name="app.country.manage", defaults={"object"=null})
     * @ParamConverter("object", class="App:Country")
     * @param AbstractEntity | Country | null $object
     * @return mixed
     */
    public function renderManagePageAction(AbstractEntity $object = null)
    {
        $formLabel = $object ? sprintf('Edit country %s', $object->getName()) : 'Add new country';
        $formType = CountryType::class;
        $formOptions = [
            'action' => $this->generateUrl('app.country.save-data', [
                'id' => $object ? $object->getId() : null
            ])
        ];

        return parent::renderPage('country', 'manage', [
            'formLabel' => $formLabel,
            'form' => parent::getForm($formType, $object, $formOptions)

        ]);
    }

    /**
     * @Route("/country/view/{country}", name="app.country.view")
     * @ParamConverter("country", class="App:Country")
     *
     * @param \App\Entity\Country $country
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderViewPageAction(Country $country)
    {
        return parent::renderPage('country', 'view', [
            'country' => $country,
            'leagues' => parent::getByParamsFromDb(League::class, ['country' => $country->getId()], ['leagueRanking' => 'ASC']),
            'urlToForm' => $this->generateUrl('app.country.add_league', [
                'country' => $country->getId()
            ])
        ]);
    }

    /**
     * @Route("/country/add-league/{country}", name="app.country.add_league")
     * @ParamConverter("country", class="App:Country")
     *
     * @param Country $country
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addLeagueAction(Country $country, Request $request)
    {
        $form = parent::getForm(LeagueType::class, null, [
            'show_country_selector' => false,
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var League $formData */
            $formData = $form->getData();
            $formData->setCountry($country);
            $this->em->persist($formData);
            $this->em->flush();

            return $this->redirectToRoute('app.country.view', [
                'country' => $country->getId()
            ]);
        }

        return parent::renderPage('league', 'manage', [
            'formLabel' => sprintf('Add new league in %s', $country->getName()),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/country/save-data/{object}", name="app.country.save-data", defaults={"object"=null})
     * @Method("POST")
     * @ParamConverter("object", class="App:Country")
     * @param Request $request
     * @param AbstractEntity|null $object
     * @return mixed|string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAction(Request $request, AbstractEntity $object = null)
    {
        $formType = CountryType::class;

        return parent::saveDataAndRedirect($formType, $request, 'app.country', $object);
    }
}