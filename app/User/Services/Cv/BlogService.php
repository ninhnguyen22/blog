<?php

namespace App\User\Services\Cv;

use App\Models\Blog\Article;
use App\Models\Blog\Category;
use Illuminate\Support\Facades\File;

class BlogService
{
    protected $title = '';
    protected $mainData;

    protected $viewPrefix = 'cv';
    protected $rootAsset = '/cv';
    protected $articleRoute = '/blog/';
    protected $catRoute = '/blog/';
    protected $mode = 'view';

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Article
     */
    protected $article;

    public function __construct(Category $category, Article $article)
    {
        $this->category = $category;
        $this->article = $article;

        if (request()->has('generate')) {
            $this->setMode('html');
        }
    }

    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setMainData($data)
    {
        $this->mainData = $data;

        return $this;
    }

    public function getMainData()
    {
        return $this->mainData;
    }

    public function getCategories($id)
    {
        return $this->category->where('id', $id)
            ->with(['categories' => function ($query) {
                $query->with('articles');
            }, 'articles'])
            ->get();
    }

    public function getTree()
    {
        return $this->category->parent()
            ->with(['categories' => function ($query) {
                $query->with('articles');
            }, 'articles'])
            ->get();
    }

    public function getDetail($id)
    {
        return $this->article->findOrFail($id);
    }

    public function getData()
    {
        return [
            '_title' => $this->getTitle(),
            '_main' => $this->getMainData(),
            '_root_asset' => $this->rootAsset,
            '_article_route' => $this->articleRoute,
            '_cat_route' => $this->catRoute
        ];
    }

    public function home()
    {
        $data = $this->getTree();
        $this->setTitle('Home');
        $this->setMainData($data);

        if ($this->getMode() === 'html') {
            $this->rootAsset = '.';
            $this->articleRoute = config('user.generate.output.articles') . DIRECTORY_SEPARATOR;
            $this->catRoute = config('user.generate.output.category') . DIRECTORY_SEPARATOR;
        }
        $dir = config('user.generate.output.base');
        $filePath = $dir . DIRECTORY_SEPARATOR . 'index.html';

        return $this->render('home', $filePath);
    }

    public function categories()
    {
        $categories = $this->category->all();
        $this->setMode('html');
        foreach ($categories as $category) {
            $id = $category->id;
            $slug = $category->slug;
            $this->category($id, $slug);
        }
        return 'cv/categories/';
    }

    public function category($id, $slug)
    {
        $category = $this->category->findOrFail($id);
        $articles = $this->getCategories($id);
        $this->setTitle($category->name);
        $this->setMainData($articles);

        if ($this->getMode() === 'html') {
            $this->rootAsset = '..';
            $this->articleRoute = '../' . config('user.generate.output.articles') . DIRECTORY_SEPARATOR;
            $this->catRoute = config('user.generate.output.category') . DIRECTORY_SEPARATOR;
        }
        $dir = config('user.generate.output.base') . DIRECTORY_SEPARATOR . 'category';
        $filePath = $dir . DIRECTORY_SEPARATOR . $slug . '-' . $id . '.html';

        return $this->render('home', $filePath);
    }

    public function detail($id, $slug)
    {
        $article = $this->getDetail($id);
        $this->setTitle($article->title);
        $this->setMainData($article);
        $dir = config('user.generate.output.base') . DIRECTORY_SEPARATOR . config('user.generate.output.articles');
        $filePath = $dir . DIRECTORY_SEPARATOR . $slug . '-' . $id . '.html';

        if ($this->getMode() === 'html') {
            $this->rootAsset = '..';
        }
        return $this->render('detail', $filePath);
    }

    public function render($path, $htmlPath = '')
    {
        $_data = $this->getData();
        $view = view($this->viewPrefix . '.' . $path, compact('_data'));

        if ($this->getMode() === 'view') {
            return $view;
        }

        if (File::put($htmlPath, $view->render())) {
            return $htmlPath;
        }
        return "Generate Fail";
    }
}
