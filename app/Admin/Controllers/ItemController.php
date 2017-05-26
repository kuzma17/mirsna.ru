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

class ItemController extends Controller
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
        return Admin::grid(Item::class, function (Grid $grid) {

            $grid->column('id')->sortable();
            $grid->column('name', 'Наименование');
            $grid->column('image', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'_50x50.jpg" style="width:50px; height:30px">';
            });
            $grid->column('type_item.name', 'Тип');
            $grid->column('brand.name', 'Бренд');
            $grid->column('spring.name', 'Пр. блок');
            $grid->column('published', 'вкл./откл.')->display(function($id){
               if($id == 1){
                   return '<span class="badge bg-green">on</span>';
               }
               return '<span class="badge bg-red">off</span>';
            });

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

            $form->tab('Основное', function($form){

                $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';
                $name_image = $this->getFileName($path.'images');
                $this->image = $name_image;

                $form->display('id', 'ID');
                $form->text('name', 'Наименование');
                $form->textarea('text', 'Текст');
                $form->image('image', 'image')->name($name_image);
                $form->select('published', 'вкл./откл.')->options([1 => 'On',0 => 'Off']);
            })->tab('Параметры', function($form){
                $form->select('type_item_id', 'Тип')->options(TypeItem::all()->pluck('name', 'id'));
                $form->select('brand_id', 'Тип')->options(Brand::all()->pluck('name', 'id'));
                $form->select('series_id', 'Серия')->options(Series::all()->pluck('name', 'id'));
                $form->select('spring_id', 'Пружинный блок')->options(Spring::all()->pluck('name', 'id'));
                $form->select('height_id', 'Высота')->options(Height::all()->pluck('name', 'id'));
                $form->select('weight_id', 'Вес на м')->options(Weight::all()->pluck('name', 'id'));
                $form->hasMany('hard', 'Жосткость', function(Form\NestedForm $form){
                    $form->select('hard_id', 'жосткость')->options(Hard::all()->pluck('name', 'id'));
                });
            })->tab('Плайс', function($form){
                $form->hasMany('price', 'Прайс', function(Form\NestedForm $form){
                    $form->select('size_id', 'размер')->options(function(){
                        $arr = [];
                        foreach(Size::all() as $size){
                          $arr[$size->id] = $size->x.' x '.$size->y;
                        }
                        return $arr;
                    });
                    $form->text('price', 'цена');
                });
            });


            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form){
                //$id = $form->id;
                $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';

                if($form->id){
                    $image = $path.Item::find($form->id)->image;
                }else{
                    $image = $path.'images/'.$this->image;
                }

               // $img = Image::make($image);
              //  $img->resize(100, 100);
              //  $img->save($image.'_100x100.jpg');

             //   $img = Image::make($image);
              //  $img->resize(50, 50);
                //$img->save($image.'_50x50.jpg');
//
             //   $img = Image::make($image);
              //  $img->resize(300, 300);
              //  $img->save($image.'_300x30.jpg');

                // return back()->with(compact('success'));
                // return redirect('/admin?id='.$image);

                $success = new MessageBag([
                    'title'   => 'title...',
                    'message' => $image,
                ]);

                return back()->with(compact('success'));
            });
        });
    }
}
