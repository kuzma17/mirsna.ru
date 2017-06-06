<?php

namespace App\Admin\Controllers;

use App\SizePillow;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class SizePillowController extends Controller
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
        return Admin::grid(SizePillow::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('x', 'Ширина');
            $grid->column('y', 'Длинна');
            $grid->column('h', 'Высота');
            $grid->column('Размер')->display(function(){
                return '<span class="badge bg-grey">'.$this->x.' x '.$this->y.' x '.$this->h.'</span>';
            });
            $grid->column('num', 'номер');
            $grid->column('status', 'Статус')->switch($this->states);

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SizePillow::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('x', 'Ширина')->rules('required');
            $form->text('y', 'Длинна')->rules('required');
            $form->text('h', 'высота')->rules('required');
            $form->number('num', 'Номер по порядку')->default(SizePillow::max('num')+1);
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (SizePillow::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
