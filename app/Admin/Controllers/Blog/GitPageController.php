<?php

namespace App\Admin\Controllers\Blog;

use App\User\Services\Cv\BlogService;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class GitPageController extends AdminController
{
    /**
     * @var BlogService
     */
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
        $this->blogService->setMode('html');
    }

    public function home()
    {
        try {
            $path = $this->blogService->home();
            return $this->response(true, $path);
        } catch (\Exception $exception) {
            return $this->response(false);
        }
    }

    public function categories()
    {
        try {
            $path = $this->blogService->categories();
            return $this->response(true, $path);
        } catch (\Exception $exception) {
            return $this->response(false);
        }
    }

    public function article(Request $request)
    {
        try {
            $id = $request->get('id');
            $slug = $request->get('slug');
            $path = $this->blogService->detail($id, $slug);
            return $this->response(true, $path);
        } catch (\Exception $exception) {
            return $this->response(false);
        }
    }

    public function category(Request $request)
    {
        try {
            $id = $request->get('id');
            $slug = $request->get('slug');
            $this->blogService->category($id, $slug);
            return $this->response(true);
        } catch (\Exception $exception) {
            return $this->response(false);
        }
    }

    private function response($status, $path = '')
    {
        return json_encode(['status' => $status, 'path' => $path]);
    }

}
