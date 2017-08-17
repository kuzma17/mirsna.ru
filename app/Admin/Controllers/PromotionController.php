<?php

namespace App\Admin\Controllers;

use App\Item;
use App\Promotion;

use App\TypeItem;
use DB;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class PromotionController extends Controller
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

            $content->header('Акции');
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

            $content->header('Акции');
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

            $content->header('Акции');
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
        return Admin::grid(Promotion::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('title', 'Название');
            $grid->column('date_from', 'дата начала');
            $grid->column('date_to', 'дата окончания');
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
        return Admin::form(Promotion::class, function (Form $form) {

            $form->tab('Основное', function(Form $form){
                $form->display('id', 'ID');
                $form->text('title', 'Название')->rules('required');
                $form->ckeditor('text', 'Описание акции');
                $form->dateRange('date_from', 'date_to', 'Период действия')->rules('required');
                $form->switch('status', 'Статус')->states($this->states)->default(1);

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            })->tab('Скидки по товарам', function(Form $form){
                $form->hasMany('discount', 'Скидки', function(Form\NestedForm $form){
                    $form->select('item_id', 'Товар')->options(function (){
                        $arrs = DB::table('items')
                            ->join('type_items', 'items.type_item_id', 'type_items.id')
                            ->select('items.id', 'type_items.name as type_item', 'items.name')
                            ->get();
                        $arr = [];
                        foreach ($arrs as $el){
                            $arr[$el->id] = $el->id.' '.$el->type_item.' "'.$el->name.'"';
                        }
                        return $arr;
                    })->rules('required');;
                    $form->rate('discount', 'Скидка')->rules('required|numeric');
                });
            });
        });
    }

    public function release(Request $request)
    {
        foreach (Promotion::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
