<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class SectionAbstractController extends Controller implements SectionInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    public $em;

    /**
     * SectionAbstractController constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param string $section
     * @param string $template
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderPage(string $section, string $template, array $parameters = [])
    {
        $view = sprintf('section/%s/%s.html.twig', $section, $template);

        return $this->render($view, $parameters);
    }

    /**
     * If $request is not set ($request = null) them method return form view
     * If $request is set, then method handle request
     *
     * @param string $formType
     * @param \App\Entity\AbstractEntity|null $data
     * @param array $options
     * @param \Symfony\Component\HttpFoundation\Request|null $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getForm(string $formType, AbstractEntity $data = null, array $options = [], Request $request = null)
    {
        $form = $this->createForm($formType, $data, $options);

        return $request ? $form->handleRequest($request) : $form;
    }

    /**
     * @param string $formType
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $routeName
     * @param \App\Entity\AbstractEntity|null $formData
     * @param array $options
     *
     * @return string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAndRedirect(string $formType, Request $request, string $routeName, AbstractEntity $formData = null, array $options = [])
    {
        /** @var Form $form */
        $form = $this->getForm($formType, $formData, $options, $request);
        $formData = $form->getData();

        if ($form->isValid()) {
            try {
                $this->em->persist($formData);
                $this->em->flush();
                return $this->redirectToRoute($routeName, ['id'=>$formData->getId()]);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }

    }

    /**
     * @param string $entityFQN
     *
     * @return \App\Entity\Association[]|object[]
     */
    public function getAllFromDb(string $entityFQN)
    {
        return $this->em->getRepository($entityFQN)->findAll();
    }

    /**
     * @param string $entityFQN
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return object[]
     */
    public function getByParamsFromDb(string $entityFQN, array $criteria, array $orderBy = null, int $limit = null, int $offset = null)
    {
        return $this->em->getRepository($entityFQN)->findBy($criteria, $orderBy, $limit, $offset);
    }
}