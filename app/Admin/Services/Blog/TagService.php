<?php

namespace App\Admin\Services\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Tag;

class TagService extends BaseService
{
    /**
     * @var Category
     */
    protected $tagModel;

    public function __construct(Tag $tag)
    {
        parent::__construct();

        $this->tagModel = $tag;
    }

    public function prepareDataForInput()
    {
        // Status
        if (request()->has('active') && request()->get('active') === 'off') {
            request()->merge(['active' => false]);
        } else {
            request()->merge(['active' => true]);
        }
    }

    public function getForSelectBox()
    {
        $all = $this->tagModel->get()->toArray();
        $tags = [];
        foreach ($all as $tag) {
            $tags[$tag['id']] = $tag['name'];
        }
        return $tags;
    }

    public function getModel()
    {
        return $this->tagModel;
    }

    public function api($q)
    {
        return $this->tagModel->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

}
