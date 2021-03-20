<?php

namespace App\User\Layout;

class Breadcrumb
{
    protected $name;
    protected $url;
    protected $isActive;

    public function __construct($name = '', $url = '', $isActive = false)
    {
        $this->name = $name;
        $this->url = $url;
        $this->isActive = $isActive;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function isActive()
    {
        return $this->isActive;
    }

}
