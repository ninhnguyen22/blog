<?php

namespace App\User\Layout;

class Breadcrumbs
{
    /**
     * @var [Breadcrumb]
     */
    protected $breadcrumbs;

    public function setBreadcrumbs($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
}
