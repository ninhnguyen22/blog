<?php

namespace App\Admin\Controllers\Blog;

use App\Admin\Services\Blog\ArticleService;
use App\Admin\Services\Blog\CategoryService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

    public function __construct(
        ArticleService $articleService,
        CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
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
            }
        });
        $grid->column('category', 'Category')->display(function ($category)  {
            return "{$category['name']}";
        });
        $grid->column('user', 'User')->display(function ($user)  {
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
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('title', trans('admin.title'))->rules('required');
        $form->text('preview', trans('admin.preview'));
        $form->ckeditor('content', 'Content')->rules('required');

        $options = $this->articleService->getOptionsForStatusInput();
        $form->radio('status', 'Status')
            ->options($options)->default(1)
            ->rules('required');
        $form->select('category_id', 'Category')
            ->options($this->categoryService->getForSelectBox())
            ->default($model->category_id)
            ->rules('required');

        $tags = $this->articleService->getOptionsForTagInput();
        $form->multipleSelect('tags')
            ->ajax('/admin/blog/api/tags')
            ->options($tags)
            ->default($tags->keys());

        $form->hidden('user_id');

        return $form;
    }

    public function store()
    {
        $this->articleService->prepareDataForInput();
        return parent::store();
    }
}
