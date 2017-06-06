<?php

namespace App\Admin\Controllers;

use App\Brand;
use App\Item;

use App\SizePillow;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;
use Request;

class PillowController extends Controller
{
    use ModelForm;

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
        return Admin::grid(Item::class, function (Grid $grid) {

            $grid->model()->where('type_item_id', 2);
            $grid->id('ID')->sortable();
            $grid->column('name', 'Наименование');
            //$grid->column('image', 'image')->image($this->image, 50);
            $grid->column('image', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'_small.jpg" style="width:50px; height:30px">';
            });
            $grid->column('brand.name', 'Бренд');
            $grid->column('price_pillow.size_pillow_id', 'Размер')->display(function($id){
                $size = SizePillow::find($id);
                return '<span class="badge">'.$size->x.' x '.$size->y.' x '.$size->h.'</span>';
            });
            $grid->column('price_pillow.price', 'Цена грн.')->label('warning');
            $grid->column('status', 'Статус')->switch($this->states);

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
        return Admin::form(Item::class, function (Form $form) {

            $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';
            $name_image = $this->getFileName($path.'images');
            $this->image = $name_image;

            $form->display('id', 'ID');
            $form->hidden('type_item_id')->value(2);
            $form->text('name', 'Наименование')->rules('required');
            $form->ckeditor('text', 'Описание продукта');
            $form->image('image', 'image')->resize(650, 400)->name($name_image);
            $form->select('brand_id', 'Тип')->options(Brand::all()->pluck('name', 'id'));
            $form->select('price_pillow.size_pillow_id')->options(function(){
                $arr = [];
                foreach(SizePillow::all() as $size){
                    $arr[$size->id] = $size->x.' x '.$size->y.' x '.$size->h;
                }
                return $arr;
            });;
            $form->currency('price_pillow.price', 'Цена')->symbol('грн.');
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form){
                if($form->image) {

                    $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

                    if ($form->id) {
                        $image = $form->image;
                    } else {
                        $image = 'images/' . $this->image;
                    }

                    $image = $path . $image;

                    $img = Image::make($image);
                    $img->resize(140, 92);
                    $img->save($image . '_small.jpg');
                }
            });
        });
    }

    public function release(Request $request)
    {
        foreach (Item::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
