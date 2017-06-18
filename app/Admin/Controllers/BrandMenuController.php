<?php

namespace App\Admin\Controllers;

use App\BrandMenu;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class BrandMenuController extends Controller
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
        return Admin::grid(BrandMenu::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('title', 'Title')->editable();
            $grid->column('logo', 'Logo')->display(function ($img){
                return '<img src="/upload/'.$img.'" style="width:100px; height:42px">';
            });
            $grid->column('num', 'Номер')->sortable();
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
        return Admin::form(BrandMenu::class, function (Form $form) {

            $path = $_SERVER['DOCUMENT_ROOT'].'/upload/';

            $name_image = $this->getFileName($path.'logo').'.jpg';

            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required');
            $form->image('logo')->resize(99, 42)->move('logo', $name_image)->rules('required')->rules('required');
            $form->text('url', 'url')->rules('required');
            $form->number('num', 'номер')->default(BrandMenu::max('num')+1);
            $form->switch('status')->states($this->states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function release(Request $request)
    {
        foreach (BrandMenu::find($request->get('ids')) as $post) {
            $post->status = $request->get('action');
            $post->save();
        }
    }
}
