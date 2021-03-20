<?php

namespace App\Admin\Controllers\Resume;

use App\Admin\Services\Resume\ResumeService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IndexController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resumes';

    /**
     * @var ResumeService
     */
    protected $resumeService;


    public function __construct(ResumeService $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->resumeService->getModel();
        $grid = new Grid($model);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('active', __('Active'))->icon([
            0 => 'toggle-off',
            1 => 'toggle-on',
        ], $default = '');


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
        $model = $this->resumeService->getModel();
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
        $model = $this->resumeService->getModel();
        $form = new Form($model);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->text('name', trans('admin.name'))->rules('required');

        $states = $this->resumeService->getStateForStatusInput();
        $form->switch('active', 'Status')->states($states)->default(1);

        return $form;
    }

    public function generate()
    {
        return view('layouts.resume');
    }

}
