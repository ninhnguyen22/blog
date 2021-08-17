<?php

namespace App\Admin\Controllers\Blog;

use App\Admin\Repositories\Interfaces\GistRepositoryInterface;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GistController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Gist';

    /**
     * @var GistRepositoryInterface
     */
    protected $gistRepository;

    public function __construct(GistRepositoryInterface $gistRepository)
    {
        $this->gistRepository = $gistRepository;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->gistRepository->model();
        $grid = new Grid($model);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('gist_id', __('Gist Id'));
        $grid->column('file_name', __('File Name'));
        $grid->column('description', __('Description'));

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
        $model = $this->gistRepository->model();
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    public function index(Content $content)
    {
        $this->gistRepository->syncAllGist();
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $model = $this->gistRepository->model();
        $form = new Form($model);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('slug', trans('admin.slug'))->rules('required');
        return $form;
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }
}
