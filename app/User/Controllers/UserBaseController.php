<?php

namespace App\User\Controllers;

use App\Admin\Services\Blog\CategoryService;
use App\User\Layout\Breadcrumb;
use App\User\Layout\Content;
use App\User\Layout\NavbarItem;
use Illuminate\Routing\Controller;

class UserBaseController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function title()
    {
        return null;
    }

    public function getView()
    {
        return 'content';
    }

    public function navbarBrand()
    {
        return config('user.name');
    }

    public function navbarItems()
    {
        $categories = $this->categoryService->getForNavbar();
        return [
            new NavbarItem('Categories', '#', true, $categories)
        ];
    }

    public function breadcrumbs()
    {
        return [
            'home' => new Breadcrumb('Home', '/', false)
        ];
    }


}
