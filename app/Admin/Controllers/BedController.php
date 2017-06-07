<?php

namespace App\Admin\Controllers;

use App\Brand;
use App\Item;

use App\PriceBed;
use App\Size;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;
use Request;

class BedController extends Controller
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

            $grid->model()->where('type_item_id', 5);
            //$grid->column('id')->sortable();
            $grid->column('name', 'Наименование');
            //$grid->column('image', 'image')->image($this->image, 50);
            $grid->column('image', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'_small.jpg" style="width:50px; height:30px">';
            });
            $grid->column('brand.name', 'Бренд');
            $grid->column('id', 'Прайс(min-max)')->display(function($id){
                $min = PriceBed::where('item_id', $id)->min('price');
                $max = PriceBed::where('item_id', $id)->max('price');
                return $min.' - '.$max;
            })->label('warning');
            $grid->column('status', 'Статус')->switch($this->states);

            //$grid->created_at();
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

            $form->tab('Основное', function(Form $form){

                $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';
                $name_image = $this->getFileName($path.'images');
                $this->image = $name_image;

                //$form->display('id', 'ID');
                $form->hidden('type_item_id')->value(5);
                $form->text('name', 'Наименование')->rules('required');
                $form->select('brand_id', 'Бренд')->options(Brand::all()->pluck('name', 'id'));
                $form->ckeditor('text', 'Описание продукта');
                $form->image('image', 'image')->resize(650, 400)->name($name_image);
                $form->switch('status')->states($this->states)->default(1);
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Прайс', function(Form $form){
                $form->hasMany('price_bed', 'Прайс', function(Form\NestedForm $form){
                    $form->select('size_id', 'размер')->options(function(){
                        $arr = [];
                        foreach(Size::all() as $size){
                            $arr[$size->id] = $size->x.' x '.$size->y;
                        }
                        return $arr;
                    });
                    $form->currency('price', 'цена')->symbol('грн.');
                });
                $form->html("<strong style='margin-left:-170px;'>Нестандартный размер</strong>");
                $form->currency('custom_price.price', 'стоимость за 1 кв. м.')->symbol('грн.');
            });

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
