<?php

namespace App\Admin\Controllers\Resume;

use App\Admin\Services\Resume\ExperienceService;
use App\Enums\ExperienceType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExperienceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Skill';

    /**
     * @var ExperienceService
     */
    protected $experienceService;


    public function __construct(ExperienceService $experienceService)
    {
        $this->experienceService = $experienceService;
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->experienceService->getModel();
        $grid = new Grid($model);

        $grid->column('id', __('ID'))->sortable();

        $grid->column('from', __('From'));
        $grid->column('to', __('To'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('type', __('Type'))->display(function ($type) {
            switch ($type) {
                case ExperienceType::ACADEMIC:
                    return "Academic";

                default:
                    return "Professional";
            }
        });

        $states = $this->experienceService->getStateForStatusInput();
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
        $model = $this->experienceService->getModel();
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->field('from', __('From'));
        $show->field('to', __('To'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));

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
        $model = $this->experienceService->getModel();
        $form = new Form($model);

        $form->saved(function () {
            $this->experienceService->generate();
        });

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->select('type', 'Type')->options([
            1 => 'Academic',
            2 => 'Professional'
        ])->default(1)->required();

        $form->date('from', 'From')->required();
        $form->date('to', 'To')->required();
        $form->text('title', 'Title')->required();
        $form->textarea('content', 'Content');


        $states = $this->experienceService->getStateForStatusInput();
        $form->switch('is_public', 'Public')->states($states)->default(1);

        return $form;
    }

}
