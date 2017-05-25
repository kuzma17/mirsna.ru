<?php

namespace App\Admin\Controllers;

use App\Weight;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class WeightController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Weight::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Вес');
            $grid->num('номер');
            $grid->column('published', 'вкл./откл.')->display(function($id){
                if($id == 1){
                    return '<span class="badge bg-green">on</span>';
                }
                return '<span class="badge bg-red">off</span>';
            });

            //$grid->created_at();
            //$grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Weight::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', 'Вес');
            $form->text('num', 'номер');
            $form->select('published', 'вкл./откл.')->options([1 => 'On',0 => 'Off']);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
