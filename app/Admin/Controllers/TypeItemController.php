<?php

namespace App\Admin\Controllers;

use App\TypeItem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Monolog\Formatter\ScalarFormatter;
use Request;

class TypeItemController extends Controller
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

            $content->header('Тип продукции');
            $content->description('');

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

            $content->header('Тип продукции');
            $content->description('');

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

            $content->header('Тип продукции');
            $content->description('');

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
        return Admin::grid(TypeItem::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('name', 'Тип');
            $grid->column('status', 'Статус')->switch($this->states);

            //$grid->created_at();
            $grid->updated_at();
            $grid->actions(function($actions){
                if(!Admin::user()->isAdministrator()) {
                    $actions->disableDelete();
                }
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(TypeItem::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', 'Тип')->rules('required');
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (TypeItem::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
