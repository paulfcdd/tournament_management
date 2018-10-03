<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class SectionAbstractController extends Controller implements SectionInterface
{
    /**
     * @param string $section
     * @param string $template
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public final function renderPage(string $section, string $template, array $parameters = [])
    {
        $view = sprintf('section/%s/%s.html.twig', $section, $template);

        return $this->render($view, $parameters);
    }

    /**
     * If $request is not set ($request = null) them method return form view
     * If $request is set, then method handle request
     *
     * @param string $formType
     * @param AbstractEntity|null $data
     * @param array $options
     * @param Request|null $request
     * @return $this|\Symfony\Component\Form\FormView
     */
    public function getForm(string $formType, AbstractEntity $data = null, array $options = [], Request $request = null)
    {
        $form = $this->createForm($formType, $data, $options);

        return $request ? $form->handleRequest($request) : $form->createView();
    }

    public function saveDataAndRedirect(string $formType, Request $request, string $routeName, AbstractEntity $formData = null, array $options = [])
    {
        /** @var Form $form */
        $form = $this->getForm($formType, $formData, $options, $request);
        $formData = $form->getData();


        if ($form->isValid()) {
            try {
                $this->getDoctrine()->getManager()->persist($formData);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute($routeName, ['id'=>$formData->getId()]);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }

    }
}