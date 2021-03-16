<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->rows(function (Grid\Row $row) {
            $row->column('number', ($row->number+1));
        });
        $grid->column('number', 'STT');
        $grid->name()->editable();
        $grid->parent_id('Parent Category')->display(function ()
        {
            return Category::find($this->parent_id)->name ?? "";
        })->label();
        $grid->column('items', 'Child Category')->display(function ()
        {
            return Category::whereParentId($this->id)->pluck('name');
        })->label();
        $grid->setActionClass(\Encore\Admin\Grid\Displayers\Actions::class);
        $grid->disableColumnSelector();
        $grid->paginate(100);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->parent_id('Parent Category')->as(function ()
        {
          return Category::find($this->parent_id)->name ?? "";
        });
        $show->name();
        $show->created_at();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->select('parent_id', 'Parent Category')->options(Category::whereNull('parent_id')->pluck('name', 'id'));
        $form->text('name')->rules('required');

        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
        });

        return $form;
    }
}
