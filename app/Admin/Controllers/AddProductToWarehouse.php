<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Models\Request;
use App\Admin\Controllers\CheckRow;

class AddProductToWarehouse extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('product_name', __('Product name'));
        $grid->column('category', __('Category'));
        $grid->column('details', __('Details'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('status', __('Status'));
        

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('category', __('Category'));
        $show->field('details', __('Details'));
        $show->field('quantity', __('Quantity'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('product_name', __('Product name'));
        $form->text('category', __('Category'));
        $form->text('details', __('Details'));
        $form->text('quantity', __('Quantity'));
        //$form->text('status', __('Status'));
        $form->checkbox('status','Status')->options([
            'Received' =>'Received',
            'Rejected' =>'Reject',
        ]);

        return $form;
    }
}
