<?php

namespace App\Admin\Services\Blog;

use App\Models\Blog\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryService extends BaseService
{
    /**
     * @var Category
     */
    protected $categoryModel;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->categoryModel = $category;
    }

    /**
     * @return Category
     */
    public function getModel()
    {
        return $this->categoryModel;
    }

    public function getForSelectBox($id = null, $prefix = '--')
    {
        $parents = $this->categoryModel->parent()->get();
        $select = [];
        return $select + $this->getForSelectBoxRecursive($parents, $id, $prefix, 0);
    }

    public function getForSelectBoxRecursive($categories, $id, $prefix, $recursiveIndent)
    {
        $select = [];
        foreach ($categories as $category) {
            if (!is_null($id) && (int)$id === $category->id) {
                continue;
            }
            $select[$category->id] = str_repeat($prefix, $recursiveIndent) . $category->name;
            $children = $category->categories();
            if ($children->count() > 0) {
                $select += $this->getForSelectBoxRecursive($children->get(), $id, $prefix, $recursiveIndent + 1);
            }
        }
        return $select;
    }

    public function getStateForStatusInput()
    {
        return [
            'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];
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

    public function getForNavbar($prefix = '&nbsp;&nbsp;')
    {
        $parents = $this->categoryModel->parent()->get();
        return $this->getForNavbarRecursive($parents, $prefix, 0);
    }

    public function getForNavbarRecursive($categories, $prefix, $recursiveIndent)
    {
        $select = [];
        foreach ($categories as $category) {
            $select[] = [
                'id' => $category->id,
                'slug' => $category->slug,
                'name' => str_repeat($prefix, $recursiveIndent) . $category->name
            ];
            $children = $category->categories();
            if ($children->count() > 0) {
                $recursiveIndent++;
                $select = array_merge($select, $this->getForNavbarRecursive($children->get(), $prefix, $recursiveIndent));
            }
            if ($recursiveIndent === 0) {
                $select[] = ['id' => 'break'];
            }
        }
        return $select;
    }

    public static function getGenerateUrl($id, $slug, $view = false)
    {
        $generate = $view ? '' : '?generate=1';

        return route('blog.category', ['slug' => Str::slug($slug), 'id' => $id]) . $generate;
    }

}
