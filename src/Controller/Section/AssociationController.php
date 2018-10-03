<?php

namespace App\Controller\Section;

use App\Controller\SectionAbstractController;
use App\Entity\AbstractEntity;
use App\Entity\Association;
use App\Form\AssociationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends SectionAbstractController
{
    /**
     * @Route("/association", name="app.association")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderListPageAction()
    {
        $associations = $this->getDoctrine()->getRepository(Association::class)->findAll();

        return parent::renderPage('association', 'list', [
            'associations' => $associations,
        ]);
    }

    /**
     * @Route("/association/manage/{id}",
     *     name="app.association.manage",
     *     defaults={"id"=null},
     *     requirements={"page"="\d+"}
     *     )
     *
     * @ParamConverter("id", class="App:Association")
     *
     * @param AbstractEntity|Association|null $id
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function renderManagePageAction(AbstractEntity $id = null)
    {
        $formLabel = $id ? sprintf('Edit association %s', $id->getName()) : 'Add new association';
        $formType = AssociationType::class;
        $formData = $id;
        $formOptions = [
            'action' => $this->generateUrl('app.association.save-data', [
                'id' => $id ? $id->getId() : null
            ])
        ];

        return parent::renderPage('association', 'manage', [
            'formLabel' => $formLabel,
            'form' => parent::getForm($formType, $formData, $formOptions)
        ]);
    }

    /**
     * @Route("/association/save-data/{id}", name="app.association.save-data", defaults={"id"=null})
     * @Method("POST")
     * @param Request $request
     * @param AbstractEntity|null $id
     * @return mixed|string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAction(Request $request, AbstractEntity $id = null)
    {
        $formType = AssociationType::class;

        return parent::saveDataAndRedirect($formType, $request, 'app.association.manage', $id);
    }
}