<?php

namespace App\View\Components;

use App\User\Layout\Breadcrumbs;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $breadcrumbs;
    /**
     * Create a new component instance.
     *
     * @param Breadcrumbs $breadcrumbs
     * @return void
     */
    public function __construct(Breadcrumbs $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
