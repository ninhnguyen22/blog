<?php

namespace App\Admin\Controllers\Blog;

use App\Admin\Services\Blog\ArticleService;
use App\Admin\Services\Blog\CategoryService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * @var ArticleService
     */
    protected $articleService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    protected $categoryList = [];

    public function __construct(
        ArticleService $articleService,
        CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;

        $this->categoryList = $this->categoryService->getForSelectBox();
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->articleService->getModel();
        $grid = new Grid($model);

        $grid->filter(function ($filter) {
            $filter->equal('category_id')->select($this->categoryList);
        });

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('preview', __('Preview'));
        $grid->column('status', 'Status')->display(function ($status) use ($model) {
            switch ($status) {
                case $model::STATUS_DRAFT:
                    return "<span class=\"text-secondary\">Draft</span>";
                case $model::STATUS_PRIVATE:
                    return "<span class=\"text-warning\">Private</span>";
                case $model::STATUS_PUBLIC:
                    return "<span class=\"text-success\">Public</span>";
                case $model::STATUS_PROTECTED:
                    return "<span class=\"text-info\">Protected</span>";
                case $model::STATUS_RECYCLE:
                    return "<span class=\"text-default\">Recycle</span>";
            }
        });
        $grid->column('category', 'Category')->display(function ($category) {
            return "{$category['name']}";
        });

        $grid->column('user', 'User')->display(function ($user) {
            return "{$user['name']}";
        });

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $model = $this->articleService->getModel();
        $item = $model->findOrFail($id);
        $slug = Str::slug($item->title);
        $show = new Show($item);

        $show->field('id', __('ID'));
        $show->field('link', __('Detail'))->as(function ($link) use ($slug, $id) {
            return route('article', [
                'slug' => $slug,
                'id' => $id
            ]);
        })->link();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('title', __('Title'));
        $show->field('preview', __('Preview'));
        $show->category('Category', function ($category) {

            $category->setResource('/admin/categories');
            $category->name();
        });

        $options = $this->articleService->getOptionsForStatusInput();
        $show->field('status', __('Status'))
            ->using($options);
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $model = $this->articleService->getModel();
        $form = new Form($model);

        $form->saved(function ($form) {
            $this->articleService->generate($form->model());
        });

        $form->editing(function ($form) {
            $date = $form->model()->updated_at->format('Y-m-d');
            $this->articleService->generateFileName($date, $form->model()->title);
        });

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('title', trans('admin.title'))->rules('required');
        $form->text('preview', trans('admin.preview'));
        $form->textarea('content', 'Content')->rules('required')->setElementClass('markdown');

        $options = $this->articleService->getOptionsForStatusInput();
        $form->radio('status', 'Status')
            ->options($options)->default(1)
            ->rules('required');
        $form->select('category_id', 'Category')
            ->options($this->categoryList)
            ->default($model->category_id)
            ->rules('required');

        $tags = $this->articleService->getOptionsForTagInput();
        $tagOptions = !empty($tags) ? $tags->keys() : [];
        $form->multipleSelect('tags')
            ->ajax('/admin/blog/api/tags')
            ->options($tags)
            ->default($tagOptions);

        $form->hidden('user_id');

        return $form;
    }

    public function store()
    {
        $this->articleService->prepareDataForInput();
        return parent::store();
    }
}
