<?php

namespace App\Admin\Controllers\Blog;

use App\Admin\Services\Blog\CategoryService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Make a grid builder.
     *
     * @param $id
     *
     * @return Grid
     */
    protected function grid($id = null)
    {
        $model = $this->categoryService->getModel();
        $grid = new Grid($model);

        if (!is_null($id)) {
            $grid->model()->where('parent_id', $id);
        } else {
            $grid->model()->parent();
        }

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('position', __('Position'));
        $grid->column('active', __('Active'))->icon([
            0 => 'toggle-off',
            1 => 'toggle-on',
        ], $default = '');
        $grid->column('categories', 'Children')->display(function ($categories) {
            $count = count($categories);
            return "<a href='" . route('admin.admin.blog.categories.index') . "?child={$this->id}'><span class='label label-warning'>{$count}</span></a>";
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
        $model = $this->categoryService->getModel();
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
        $model = $this->categoryService->getModel();
        $form = new Form($model);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('slug', trans('admin.slug'))->rules('required');
        $form->textarea('description', 'Description');

        $states = $this->categoryService->getStateForStatusInput();
        $form->switch('active', 'Status')->states($states)->default(1);
        $form->select('parent_id', 'Parent')
            ->options($this->categoryService->getForSelectBox(request('category')))
            ->default($model->id);

        return $form;
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid(request()->get('child')));
    }

    public function store()
    {
        $this->categoryService->prepareDataForInput();
        return parent::store();
    }

    public function update($id)
    {
        $this->categoryService->prepareDataForInput();
        return parent::update($id);
    }
}
