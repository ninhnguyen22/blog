<?php

namespace App\Admin\Controllers\Resume;

use App\Admin\Services\Resume\SkillService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;

class SkillController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Skill';

    /**
     * @var SkillService
     */
    protected $skillService;


    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->skillService->getModel();
        $grid = new Grid($model);

        $grid->column('id', __('ID'))->sortable();

        $grid->column('name', __('Name'));
        $grid->column('level', __('Level'));
        $grid->column('time', __('Time'));

        $grid->column('image', __('Image'))
            ->image($this->skillService->getImagePathPrefix(), 100, 100);

        $states = $this->skillService->getStateForStatusInput();
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
        $model = $this->skillService->getModel();
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->field('name', __('Name'));
        $show->field('level', __('Level'));
        $show->field('time', __('Time'));

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
        $model = $this->skillService->getModel();
        $form = new Form($model);

        $form->saved(function () use ($form) {
            $this->skillService->afterSaved($form->model());
            $this->skillService->generate();
        });

        $form->deleted(function () {
            $this->skillService->generate();
        });

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->select('name', 'Name')->options($this->skillService->getNameSelect());

        $form->text('level', 'Level');
        $form->text('time', 'Time');
        $form->image('image', 'Image')->move('portfolio');

        $states = $this->skillService->getStateForStatusInput();
        $form->switch('is_public', 'Public')->states($states)->default(1);

        return $form;
    }

}
