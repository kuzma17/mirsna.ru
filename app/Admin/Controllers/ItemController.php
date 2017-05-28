<?php

namespace App\Admin\Controllers;

use App\Brand;
use App\Hard;
use App\Height;
use App\Item;

use App\Series;
use App\Size;
use App\Spring;
use App\TypeItem;
use App\Weight;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Image;
use Request;

class ItemController extends Controller
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

            $grid->column('id')->sortable();
            $grid->column('name', 'Наименование');
            //$grid->column('image', 'image')->image($this->image, 50);
            $grid->column('image', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'_100x50.jpg" style="width:50px; height:30px">';
            });
            $grid->column('type_item.name', 'Тип');
            $grid->column('brand.name', 'Бренд');
            $grid->column('spring.name', 'Пр. блок');
            $grid->column('status', 'Статус')->switch($this->states);

            //$grid->created_at();
            $grid->updated_at();
            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('name', 'Наименование');
                $filter->is('type_item_id', 'тип')->select(TypeItem::all()->pluck('name', 'id'));
                $filter->is('brand_id', 'бренд')->select(Brand::all()->pluck('name', 'id'));
            });
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
                $form->text('name', 'Наименование')->rules('required');
                $form->ckeditor('text', 'Текст');
                $form->image('image', 'image')->resize(300, 200)->name($name_image);
                $form->switch('status')->states($this->states)->default(1);
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Параметры', function(Form $form){
                $form->select('type_item_id', 'Тип')->options(TypeItem::all()->pluck('name', 'id'));
                $form->select('brand_id', 'Тип')->options(Brand::all()->pluck('name', 'id'));
                $form->select('series_id', 'Серия')->options(Series::all()->pluck('name', 'id'));
                $form->select('spring_id', 'Пружинный блок')->options(Spring::all()->pluck('name', 'id'));
                $form->select('height_id', 'Высота')->options(Height::all()->pluck('name', 'id'));
                $form->select('weight_id', 'Вес на м')->options(Weight::all()->pluck('name', 'id'));
                $form->hasMany('hard', 'Жосткость', function(Form\NestedForm $form){
                    $form->select('hard_id', 'жосткость')->options(Hard::all()->pluck('name', 'id'));
                });
            })->tab('Прайс', function(Form $form){
                $form->hasMany('price', 'Прайс', function(Form\NestedForm $form){
                    $form->select('size_id', 'размер')->options(function(){
                        $arr = [];
                        foreach(Size::all() as $size){
                          $arr[$size->id] = $size->x.' x '.$size->y;
                        }
                        return $arr;
                    });
                    $form->currency('price', 'цена');
                });
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

                    // $img = Image::make($image);
                    //  $img->resize(100, 100);
                    //  $img->save($image.'_100x100.jpg');

                    $img = Image::make($image);
                    $img->resize(150, 100);
                    $img->save($image . '_150x100.jpg');
//
                    $img = Image::make($image);
                    $img->resize(100, 50);
                    $img->save($image.'_100x50.jpg');

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
