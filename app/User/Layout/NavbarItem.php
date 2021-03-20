<?php

namespace App\User\Layout;

class NavbarItem
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $href;

    /**
     * @var bool
     */
    protected $isDropdown = false;

    protected $id;

    protected $classes;

    protected $dropdowns = [];

    /**
     * NavbarItem constructor.
     * @param $name
     * @param string $href
     * @param bool $isDropdown
     * @param array $dropdowns
     * @param null $id
     * @param array $classes
     */
    public function __construct($name, $href = '#', $isDropdown = false, $dropdowns = [], $id = null, $classes = [])
    {
        $this->name = $name;
        $this->href = $href;
        $this->isDropdown = $isDropdown;
        $this->id = $id;
        $this->classes = $classes;
        $this->dropdowns = $dropdowns;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function getIsDropdown()
    {
        return $this->isDropdown;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function getDropdowns()
    {
        return $this->dropdowns;
    }
}
