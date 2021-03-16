<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use GuzzleHttp\Psr7\Request;

class ProductController extends AdminController
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

        $grid->rows(function (Grid\Row $row) {
            $row->column('number', ($row->number+1));
        });
        $grid->column('number', 'STT');
        $grid->avatar()->lightbox(['width' => 100, 'height' => 100]);
        $grid->code()->editable();
        $grid->name()->editable();
        $grid->category_id('Category')->display(function () {
            return Category::find($this->category_id)->name;
        })->label();

        $grid->images()->gallery(['width' => 50, 'height' => 50]);

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
        $show = new Show(Product::findOrFail($id));

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
        $form = new Form(new Product);

        $form->image('avatar')
            ->thumbnail('small', $width = 300, $height = 300)
            ->rules('required');
        $form->select('category_id', 'Category')
            ->options(Category::all()->pluck('name', 'id'))
            ->rules('required');
        $form->text('code', 'Product Code')
            ->rules('required');
        $form->text('name', 'Product Name')
            ->rules('required');
        $form->text('weight');
        $form->text('height');
        $form->text('length');
        $form->text('width');
        $form->text('color');
        $form->summernote('material');
        $form->summernote('description');
        $form->multipleImage('images', 'Image (3)')->thumbnail('small', $width = 100, $height = 100);

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
