<?php

namespace App\Admin\Controllers;

use App\Slideshow;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;

class SlideshowController extends Controller
{
    use ModelForm;

    protected $image;

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
        return Admin::grid(Slideshow::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('image', 'картинка')->display(function ($img){
                return '<img src="/upload/'.$img.'" style="width:200px; height:60px">';
            });
            $grid->column('title', 'текст');
            $grid->column('num', 'номер');
            $grid->column('published', 'Публикация')->display(function($id){
                if($id == 1){
                    return '<span class="badge bg-green">on</span>';
                }
                return '<span class="badge bg-red">off</span>';
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    public static function getFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Slideshow::class, function (Form $form) {

            $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';

            $name_image = $this->getFileName($path.'slider').'.jpg';

            $this->image = $name_image;

            $form->display('id', 'ID');
            $form->image('image')->move('slider', $name_image);;
            $form->text('title', 'текст');
            $form->text('num', 'номер');
            $form->select('published', 'Публиковать')->options([0 => 'Off', 1 => 'On']);

            //$form->display('created_at', 'Created At');
           // $form->display('updated_at', 'Updated At');
            $form->saved(function (Form $form){
                //$id = $form->id;
                $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';

                if($form->id){
                    $image = $path.Slideshow::find($form->id)->image;
                }else{
                    $image = $path.'slider/'.$this->image;
                }


                $img = Image::make($image);
                $img->resize(730, 250);
                $img->save($image);


                // return back()->with(compact('success'));
                // return redirect('/admin?id='.$image);
            });
        });
    }
}
