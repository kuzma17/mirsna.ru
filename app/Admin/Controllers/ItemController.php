<?php

namespace App\Admin\Controllers;

use App\Brand;
use App\ClassItem;
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

            $content->header('Items');
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

            $content->header('Items');
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

            $content->header('Items');
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
        return Admin::grid(Item::class, function (Grid $grid) {

            $grid->column('id')->sortable();
            $grid->column('name', 'Наименование');
            //$grid->column('image', 'image')->image($this->image, 50);
            $grid->column('image', 'image')->display(function ($img){
                return '<img src="/upload/'.$img.'" style="width:50px; height:30px">';
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
                $filter->is('status', 'Статус')->select([1 => 'ON', 0 => 'OFF']);
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
        return Admin::form(Item::class, function (Form $form) {

            $form->tab('Основное', function(Form $form){

                $form->display('id', 'ID');
                $form->text('name', 'Наименование')->rules('required');
                $form->ckeditor('text', 'Описание продукта');
                $form->image('image', 'image')->resize(650, 400)->uniqueName()->move('images');
                $form->switch('status')->states($this->states)->default(1);
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Параметры', function(Form $form){
                $form->select('type_item_id', 'Тип')->options(TypeItem::all()->pluck('name', 'id'));
                $form->select('brand_id', 'Бренд')->options(function(){
                    $arrs = Brand::where('status', 1)->get();
                    $arr[0] = ' - ';
                    foreach ($arrs as $el){
                        $arr[$el->id] = $el->id.' '.$el->name;
                    }
                    return $arr;
                });
                $form->select('series_id', 'Серия')->options(function(){
                    $arrs = Series::where('status', 1)->get();
                    $arr[0] = ' - ';
                    foreach ($arrs as $el){
                        $arr[$el->id] = $el->id.' '.$el->name;
                    }
                    return $arr;
                });
                $form->select('class_id', 'Класс')->options(function(){
                    $arrs = ClassItem::where('status', 1)->get();
                    $arr[0] = ' - ';
                    foreach ($arrs as $el){
                        $arr[$el->id] = $el->id.' '.$el->name;
                    }
                    return $arr;
                });
                $form->select('spring_id', 'Пружинный блок')->options(function(){
                    $arrs = Spring::where('status', 1)->get();
                    $arr[0] = ' - ';
                    foreach ($arrs as $el){
                        $arr[$el->id] = $el->id.' '.$el->name;
                    }
                    return $arr;
                });
                $form->select('height_id', 'Высота')->options(function(){
                    $arr = Height::where('status', 1)->get()->pluck('name', 'id');
                    $arr[0] = ' - ';
                    return $arr;
                });
                $form->select('weight_id', 'Вес на м')->options(function(){
                    $arr = Weight::where('status', 1)->get()->pluck('name', 'id');
                    $arr[0] = ' - ';
                    return $arr;
                });
                $form->multipleSelect('hard', 'Жосткость')->options(Hard::all()->pluck('name', 'id'))->placeholder('Жосткость');
            })->tab('Прайс', function(Form $form){
                $form->hasMany('price', 'Прайс', function(Form\NestedForm $form){
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
