<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\AbstractEntity;
use App\Entity\Club;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends SectionAbstractController
{
    /**
     * @Route("/clubs", name="app.club")
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function renderListPageAction()
    {
        return parent::renderPage('club', 'list', [
            'clubs' => $this->getAllFromDb(Club::class),
        ]);
    }

    /**
     * @Route("/club/manage/{entity}", name="app.club.manage", defaults={"entity"=null})
     * @ParamConverter("entity", class="App:Club")
     * @param \App\Entity\AbstractEntity|null $entity
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function renderManagePageAction(AbstractEntity $entity = null)
    {
        $formLabel = $entity ? sprintf('Edit country %s', $entity->getName()) : 'Add new country';
        $formType = '';
        $formOptions = [
            'action' => $this->generateUrl('app.country.save-data', [
                'id' => $entity ? $entity->getId() : null
            ])
        ];

        return parent::renderPage('club', 'manage', [
            'formLabel' => $formLabel,
            'form' => parent::getFormInterface($formType, $entity, $formOptions)->createView()
        ]);
    }

    public function saveDataAction(Request $request, AbstractEntity $object)
    {
        // TODO: Implement saveDataAction() method.
    }
}