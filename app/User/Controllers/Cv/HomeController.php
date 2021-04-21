<?php

namespace App\User\Controllers\Cv;

use App\User\Services\Cv\BlogService;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * @var BlogService
     */
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        return $this->blogService->home();
    }

    public function category($slug, $id)
    {
        return $this->blogService->category($id, $slug);
    }

    public function categories()
    {
        return $this->blogService->categories();
    }

    public function detail($slug, $id)
    {
        return $this->blogService->detail($id, $slug);
    }
}
