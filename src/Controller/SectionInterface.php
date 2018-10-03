<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use Symfony\Component\HttpFoundation\Request;

interface SectionInterface
{
    /**
     * @return mixed
     */
    public function renderListPageAction();

    /**
     * @param AbstractEntity $entity
     * @return mixed
     */
    public function renderManagePageAction(AbstractEntity $entity = null);

    /**
     * @param Request $request
     * @param AbstractEntity $entity
     * @return mixed
     */
    public function saveDataAction(Request $request,
                                   AbstractEntity $entity);

}