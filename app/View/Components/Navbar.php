<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $navbar;

    /**
     * Create a new component instance.
     *
     * @param \App\User\Layout\Navbar $navbar
     * @return void
     */
    public function __construct(\App\User\Layout\Navbar $navbar)
    {
        $this->navbar = $navbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
