<?php

namespace App\Admin\Controllers;

use App\Models\Intern;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InternController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Intern';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Intern());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('birth', __('Birth'));
        $grid->column('image', __('Image'))->image('',60,60);

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
        $show = new Show(Intern::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('birth', __('Birth'));
        $show->field('image', __('Image'))->image('',60,60);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Intern());

        $form->text('name', __('Name'));
        $form->datetime('birth', __('Birth'))->default(date('Y-m-d H:i:s'));
        $form->image('image', __('Image'));

        // callback before form submission
        /*$form->saving(function (Form $form) {
            return redirect('/admin/users');
        });*/
        //database e data add hoyna
        $form->saving(function (Form $form) {
            return response('xxxx');
        });

        
        //callback after form submission
        // database e data add hoyna
        /*$form->submitted(function (Form $form) {
            return response('xxxx');
        });*/

        // callback after save
        // database e data add hobe
        /*$form->saved(function (Form $form) {
            return response('xxxx');
        });*/

        return $form;
    }
}
