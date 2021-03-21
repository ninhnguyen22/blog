<?php

namespace App\User\Controllers;

use App\Admin\Services\Blog\CategoryService;
use App\User\Layout\Breadcrumb;
use App\User\Layout\Content;
use App\User\Services\Article\ArticleCondition;
use App\User\Services\HomeService;
use Illuminate\Support\Facades\File;

class HomeController extends UserBaseController
{
    /**
     * @var HomeService
     */
    protected $homeService;

    protected $view = 'home';

    public function __construct(CategoryService $categoryService, HomeService $homeService)
    {
        parent::__construct($categoryService);

        $this->homeService = $homeService;
    }

    /**
     * Titles
     * @return string|null
     */
    public function title()
    {
        return config('user.name') . ' | Home';
    }

    public function getView()
    {
        return $this->view;
    }

    public function breadcrumbs()
    {
        $breadcrumbs = parent::breadcrumbs();
        $breadcrumbs['categories'] = new Breadcrumb('Categories', '', true);

        return $breadcrumbs;
    }

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        $cond = new ArticleCondition();
        return $this->getContent($content)
            ->setData($this->homeService->getArticleList($cond));
    }

    /**
     * Category interface.
     *
     * @param string $slug
     * @param int $id
     * @param Content $content
     *
     * @return Content
     */
    public function category($slug, $id, Content $content)
    {
        $cond = new ArticleCondition();
        $cond->setCategory($id, $slug);
        return $this->getContent($content)
            ->setData($this->homeService->getArticleList($cond));
    }

    public function article($slug, $id, Content $content)
    {
        $this->view = 'article';
        $cond = new ArticleCondition();
        $cond->setCategory($id, $slug);

        $view = $this->getContent($content)
            ->setData($this->homeService->getArticleDetail($id));

        if (request()->has('generate')) {
            return File::put(request()->get('generate'), $view->render());
        }

        return $view;
    }

    protected function getContent(Content $content)
    {
        return $content
            ->setView($this->getView())
            ->title($this->title())
            ->navbar($this->navbarBrand(), $this->navbarItems())
            ->breadcrumb($this->breadcrumbs());
    }

}
