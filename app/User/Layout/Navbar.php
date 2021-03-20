<?php

namespace App\User\Layout;

class Navbar
{
    /**
     * @var string
     */
    protected $brand;

    protected $navItems;

    public function __construct($brand = null, $navItems = [])
    {
        $this->setBrand($brand);
        $this->setNavItems($navItems);
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getNavItems()
    {
        return $this->navItems;
    }

    public function setBrand($brand)
    {
        if (is_null($brand)) {
            $brand = config('user.name');
        }
        $this->brand = $brand;
    }

    public function setNavItems($navItems)
    {
        $this->navItems = $navItems;
    }
}
