<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
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
        //$form->text('quantity', __('Quantity'));
        $form->text('category', __('Category'));
        $form->text('stock', __('Stock'));
        //$form->text('status', __('Status'));
        $form->date('date', __('Date'));
        //$form->number('pid', __('Pid'));



        $form->saving(function (Form $form) {

            $product = Product :: where('product_name',$form->name)->first();
            
            $cal = (int) $form->quantity- (int)$form->stock;
            $form->model()->status = "Requested";
            if($cal <0){
                admin_toastr('Message...', 'error', ['timeOut' => 5000]); 
                admin_success('Error', 'Insufficient Stock!');
            }else{
                $form->stock = $form->stock;
                $form->quantity = $cal;
                $form->model()->pid = $product->id;

                $product->quantity =  $cal;
                $product->save();
            }
        });
        

        return $form;
    }
}
