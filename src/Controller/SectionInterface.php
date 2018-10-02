<?php

namespace App\Controller;

use App\Entity as Entity;

interface SectionInterface
{
    public function renderListPageAction();

    /**
     * @param $data
     * @return mixed
     */
    public function renderManagePageAction($data);
}