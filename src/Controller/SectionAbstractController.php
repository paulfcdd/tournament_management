<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
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
     *
     * @param string $formType
     * @param \App\Entity\AbstractEntity|null $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getFormInterface(string $formType, AbstractEntity $data = null, array $options = [])
    {
        $formInstance = $this->createForm($formType, $data, $options);

        return $formInstance;
    }

    /**
     * @param string $formType
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $routeName
     * @param \App\Entity\AbstractEntity|null $formData
     * @param array $options
     * @param array $routeParameters
     *
     * @return string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveDataAndRedirect(
        string $formType,
        Request $request,
        string $routeName,
        AbstractEntity $formData = null,
        array $options = [],
        array $routeParameters = []
    )
    {
        /** @var Form $form */
        $form = $this->getFormInterface($formType, $formData, $options)->handleRequest($request);

        if ($form->isValid()) {

            $formData = $form->getData();

            try {
                $this->em->persist($formData);
                $this->em->flush();
                return $this->redirectToRoute($routeName, $routeParameters);
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