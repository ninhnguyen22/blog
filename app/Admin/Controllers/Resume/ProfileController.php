<?php

namespace App\Admin\Controllers\Resume;

use App\Admin\Services\Resume\ProfileService;
use App\Enums\ProfileType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProfileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Profile';

    /**
     * @var ProfileService
     */
    protected $profileService;


    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Make a grid builder.
     *
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = $this->profileService->getModel();
        $grid = new Grid($model);

        $grid->model()->orderBy('type', 'asc')
            ->orderBy('content_key', 'asc');

        $grid->column('id', __('ID'))->sortable();
        $grid->header(function ($query) {
            $action = route('admin.admin.resume.generate');
            return view('components.resume.generate-button', compact('action'));
        });

        $grid->column('type', 'Type')->display(function ($type) {
            switch ($type) {
                case ProfileType::NETWORK:
                    return "Network";
                case ProfileType::CONTACT:
                    return "Contact";
                default:
                    return "Main";
            }
        });

        $grid->column('name', __('Name'));

        $grid->column('icon', __('Icon'));

        $grid->column('content_key', __('Content Key'));
        $grid->column('content_value', __('Content Value'));
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
        $model = $this->profileService->getModel();
        $show = new Show($model->findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('name', __('Name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $model = $this->profileService->getModel();
        $form = new Form($model);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $typeSelectBox = array_flip($this->profileService->getForSelectBox());
        $form->select('type', 'Type')
            ->options($typeSelectBox)
            ->rules('required');

        $form->text('name', 'Name');
        $form->text('icon', 'Icon');

        $form->text('content_key', 'Content Key')->rules('required');
        $form->text('content_value', 'Content Value')->rules('required');
        $states = $this->profileService->getStateForStatusInput();
        $form->switch('active', 'Active')->states($states)->default(1);

        return $form;
    }

}
