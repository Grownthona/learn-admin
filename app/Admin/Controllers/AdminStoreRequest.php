<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Request;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminStoreRequest extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('category', __('Category'));
        $grid->column('stock', __('Stock'));
        $grid->column('status', __('Status'));
        $grid->column('date', __('Date'));
        //$grid->column('pid', __('Pid'));

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
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('quantity', __('Quantity'));
        $show->field('category', __('Category'));
        $show->field('stock', __('Stock'));
        $show->field('status', __('Status'));
        $show->field('date', __('Date'));
        $show->field('pid', __('Pid'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Store());

        $form->text('name', __('Name'));
        $form->text('quantity', __('Quantity'));
        $form->text('category', __('Category'));
        $form->text('stock', __('Stock'));
        $form->text('status', __('Status'));
        $form->date('date', __('Date'));
        $form->number('pid', __('Pid'));

        $form->saving(function (Form $form) {

            if($form->status=="Accept"){
               $addrequest = new Request;
               $addrequest->name = $form->name;
               $addrequest->quantity = $form->quantity;
               $addrequest->status = "pending to ship";
               $addrequest->date = $form->date;
               $addrequest->stock = $form->stock;
               $addrequest->pid = $form->pid;
               $addrequest->save();
               admin_toastr('Message...', 'success', ['timeOut' => 5000]); 
               admin_success('Success', 'Product request Accepted!');
            }else{
                RequestInven::where('pid',$form->pid)->delete();
            }

        });

        return $form;
    }
}
