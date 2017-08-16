<?php

namespace App\Admin\Controllers;

use App\Size;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class SizeController extends Controller
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

            $content->header('Размеры');
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

            $content->header('Размеры');
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

            $content->header('Размеры');
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
        return Admin::grid(Size::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('x', 'Ширина');
            $grid->column('y', 'Длинна');
            $grid->column('Размер')->display(function(){
                return '<span class="badge bg-grey">'.$this->x.' x '.$this->y.'</span>';
            });
            $grid->column('num', 'номер');
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
        return Admin::form(Size::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->number('x', 'Ширина')->rules('required');
            $form->number('y', 'Длинна')->rules('required');
            $form->number('num', 'Номер по порядку')->default(Size::max('num')+1);
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (Size::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
