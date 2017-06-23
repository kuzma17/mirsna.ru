<?php

namespace App\Admin\Controllers;

use App\ClassItem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class ClassController extends Controller
{
    use ModelForm;

    protected $states = [
        'on' => ['text' => 'ON', 'color' => 'success'],
        'off' => ['text' => 'OFF', 'color' => 'danger'],
    ];

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Классы');
            $content->description('матрасов');

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

            $content->header('Классы');
            $content->description('матрасов');

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

            $content->header('Классы');
            $content->description('матрасов');

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
        return Admin::grid(ClassItem::class, function (Grid $grid) {

            $grid->column('id','ID')->sortable();
            $grid->column('name', 'Класс');
            $grid->column('num','номер');
            $grid->column('status', 'Статус')->switch($this->states);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(ClassItem::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', 'Класс')->rules('required');
            $form->number('num', 'Номер по порядку')->default(ClassItem::max('num')+1);
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (ClassItem::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
