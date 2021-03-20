<?php

namespace App\User\Layout;

use Illuminate\Contracts\Support\Renderable;

class Content implements Renderable
{
    /**
     * @var Head
     */
    protected $head;

    protected $navbar;

    protected $view;

    /**
     * @var Breadcrumbs
     */
    protected $breadcrumbs;

    protected $data;

    public function __construct(Head $head, Navbar $navbar, Breadcrumbs $breadcrumbs, $view = null)
    {
        $this->head = $head;
        $this->navbar = $navbar;
        $this->breadcrumbs = $breadcrumbs;
        $this->view = $view;
    }

    public function getHead()
    {
        return $this->head;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function title($title)
    {
        $this->head->setTitle($title);

        return $this;
    }

    /**
     * @param $brand
     * @param $navItems
     * @return $this
     */
    public function navbar($brand, $navItems)
    {
        $this->navbar->setBrand($brand);
        $this->navbar->setNavItems($navItems);

        return $this;
    }

    public function breadcrumb($breadcrumbs = [])
    {
        $this->breadcrumbs->setBreadcrumbs($breadcrumbs);

        return $this;
    }

    /**
     * Render this content.
     *
     * @return string
     */
    public function render()
    {
        $items = [
            'head' => $this->head,
            'navbar' => $this->navbar,
            'breadcrumbs' => $this->breadcrumbs,
            '_data' => $this->data
            /*'header'      => $this->title,
            'description' => $this->description,
            'breadcrumb'  => $this->breadcrumb,
            '_content_'   => $this->build(),content
            '_view_'      => $this->view,
            '_user_'      => $this->getUserData(),*/
        ];

        return view($this->view, $items)->render();
    }
}
