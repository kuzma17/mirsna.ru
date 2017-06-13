<?php

namespace App\Admin\Controllers;

use App\Category;

use App\Menu;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class CategoryController extends Controller
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

            $content->header('Меню категорий');
            $content->description('Спмсок');

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
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('parent_id', 'Родительская категория')->display(function($id){
                if($id == 0){
                    return 'root';
                }
                return Category::find($id)->title;
            })->sortable();
            $grid->column('title', 'Название');
            $grid->column('url', 'url');
            $grid->column('num', 'Номер по порядку')->sortable();
            $grid->column('status', 'Статус')->switch($this->states);

            $grid->created_at();
            $grid->updated_at();
            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->is('parent_id', 'родитель')->select(Category::where('status', 1)->get()->pluck('title', 'id'));
            });
            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

           // $form->display('id', 'ID');
            $form->select('parent_id', 'Родительская категория')->options(function(){
                $arrs = Category::where('status', 1)->get();
                $arr[0] = '0 root';
                foreach ($arrs as $el){
                    $arr[$el->id] = $el->id.' '.$el->title;
                }
                return $arr;
            });
            $form->text('title', 'Название')->rules('required');
            $form->text('url', 'Ссилка');
            $form->number('num', 'Номер по порядку')->default(Category::max('num') + 1);
            $form->switch('status')->states($this->states)->default(1);

           // $form->display('created_at', 'Created At');
            //$form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (Category::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
