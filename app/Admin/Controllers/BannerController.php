<?php

namespace App\Admin\Controllers;

use App\Banner;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;
use Request;

class BannerController extends Controller
{
    use ModelForm;

    protected $id;
    protected $image;

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
        $this->id = $id;
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
        return Admin::grid(Banner::class, function (Grid $grid) {

            $grid->column('id')->sortable();
            $grid->column('name', 'Баннер');
            $grid->column('img', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'" style="width:50px; height:30px">';
            });
            $grid->column('status', 'Статус')->switch($this->states);
            $grid->disableCreation();
            $grid->actions(function($actions){
                    $actions->disableDelete();
            });

            $grid->created_at();
            $grid->updated_at();
            $grid->disableExport();

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
        return Admin::form(Banner::class, function (Form $form) {

            $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';
            $name_image = $this->getFileName($path.'banners').'.jpg';

            $this->image = $name_image;

            $form->text('id', 'ID');
            $form->display('name');
            //$form->html($size_x.' '.$size_y);
            $form->image('img', 'image')->move('banners', $name_image);
            $form->url('url', 'Url');
            $form->textarea('code', 'Code');
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form){

                $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

                //$image = $form->image;

                $image = 'banners/' . $this->image;
                $image = $path . $image;

                if($form->id == 4){
                    $size_x = 200;
                    $size_y = 200;
                }else{
                    $size_x = 800;
                    $size_y = 200;
                }

                $img = Image::make($image);
                $img->resize($size_x, $size_y);
                $img->save($image);

            });
        });
    }

    public function release(Request $request)
    {
        foreach (Banner::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
