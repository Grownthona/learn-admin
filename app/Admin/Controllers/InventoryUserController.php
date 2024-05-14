<?php

namespace App\Admin\Controllers;

use App\Models\InventoryUser;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\Hash;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InventoryUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'InventoryUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new InventoryUser());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('role', __('Role'));
        $grid->column('joining', __('Joining'));
        $grid->column('password', __('Password'));

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
        $show = new Show(InventoryUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('role', __('Role'));
        $show->field('joining', __('Joining'));
        $show->field('password', __('Password'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new InventoryUser());

        $form->text('name', __('Name'))->rules('required|min:4');
        
        //$form->text('role', __('Role'));
        $form->select('role', __('Role'))->options(['Admin' => 'Admin', 'Warehouse Manager' => 'Warehouse Manager', 'Store Manager' => 'Store Manager']);

        $form->date('joining', __('Joining'));
        $form->password('password', __('Password'))->rules('required|regex:/^\d+$/|min:6', [
            'regex' => 'code must be numbers',
            'min'   => 'code can not be less than 10 characters',
        ]);

        $form->saving(function ($form) {
            Hash::make($form->model()->password);
        });

        return $form;
    }
}
