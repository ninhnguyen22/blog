<?php

namespace App\Admin\Controllers\Resume;

use App\Admin\Services\Resume\ProjectService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Skill';

    /**
     * @var ProjectService
     */
    protected $projectService;


    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->projectService->getModel();
        $grid = new Grid($model);

        $grid->column('id', __('ID'))->sortable();

        $grid->column('title', __('Title'));
        $grid->column('link', __('Link'));
        $grid->column('image', __('Image'))->image();
        $grid->column('tag', __('Tag'));
        $grid->column('color', __('Color'));
        $grid->column('date', __('Date'));

        $states = $this->projectService->getStateForStatusInput();
        $grid->column('is_public')->switch($states);


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
        $model = $this->projectService->getModel();
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('link', __('Link'));
        $show->field('image', __('Image'));
        $show->field('tag', __('Tag'));
        $show->field('color', __('Color'));
        $show->field('date', __('Date'));

        $show->field('is_public', __('Public'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $model = $this->projectService->getModel();
        $form = new Form($model);

        $form->saved(function () use ($form) {
            $this->projectService->afterSaved($form->model());
            $this->projectService->generate();
        });

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('title', 'Title');
        $form->textarea('content', 'Content');
        $form->text('link', 'Link');
        $form->image('image', 'Image')->move('portfolio');
        $form->text('tag', 'Tag');
        $form->select('color', 'Color')
            ->options($this->projectService->getColors());
        $form->date('date', 'Date');

        $states = $this->projectService->getStateForStatusInput();
        $form->switch('is_public', 'Public')->states($states)->default(1);

        return $form;
    }

}
