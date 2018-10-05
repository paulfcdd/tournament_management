<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\AbstractEntity;
use App\Entity\League;
use App\Form\LeagueType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LeaguesController extends SectionAbstractController
{
    /**
     * @Route("/league", name="app.league")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderListPageAction()
    {
        return parent::renderPage('league', 'list', [
            'leagues' => parent::getAllFromDb(League::class),
        ]);
    }

    /**
     * @Route("/league/manage/{object}", name="app.league.manage", defaults={"object"=null})
     * @ParamConverter("object", class="App:League")
     *
     * @param AbstractEntity|League|null $object
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function renderManagePageAction(AbstractEntity $object = null)
    {
        $formLabel = $object ? sprintf('Edit league %s', $object->getName()) : 'Add new league';
        $formType = LeagueType::class;
        $formOptions = [
            'action' => $this->generateUrl('app.league.save-data', [
                'object' => $object ? $object->getId() : null
            ]),
            'show_country_selector' => true
        ];

        return parent::renderPage('league', 'manage', [
            'form' => parent::getForm($formType, $object, $formOptions),
            'formLabel' => $formLabel,
        ]);
    }

    /**
     * @Route("/league/save-data/{object}", name="app.league.save-data", defaults={"object"=null})
     * @Method("POST")
     * @ParamConverter("object", class="App:League")
     * @param Request $request
     * @param AbstractEntity|League|null $object
     * @return mixed|string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAction(Request $request, AbstractEntity $object = null)
    {
        return parent::saveDataAndRedirect(LeagueType::class, $request, 'app.league', $object);
    }
}