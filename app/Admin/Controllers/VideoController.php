<?php

namespace App\Admin\Controllers;

use App\Video;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Request;

class VideoController extends Controller
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

            $content->header('Видео');
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

            $content->header('Видео');
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

            $content->header('Видео');
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
        return Admin::grid(Video::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('url_video', 'видео')->display(function ($url){
                return '<div><iframe width="120" height="50" src="'.$url.'&showinfo=0&wmode=opaque&wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';
            });
            $grid->column('url_site', 'url на сайте');
            $grid->column('status', 'Статус')->switch($this->states);

            //$grid->created_at();
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
        return Admin::form(Video::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->html(function (){
                return '<div><iframe width="560" height="315" src="'.$this->url_video.'&showinfo=0&wmode=opaque&wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';
            });
            $form->url('url_video', 'url видео')->rules('required');
            $form->url('url_site', 'url на сайте')->rules('required');
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            //$form->saving(function ($form){
               // $path = str_replace('http://', '', $form->url_site);
                //$path = str_replace('www', '', $path);
               // $path = str_replace(Request::getHost(), '', $path);
                //$form->url_site = $path;
               // return $form->url_site;
            //});
        });
    }

    public function release(Request $request)
    {
        foreach (Video::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
