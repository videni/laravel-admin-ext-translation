<?php

namespace Encore\Admin\Translation;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class LocaleController
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('admin.translation.locale_header'));
            $content->description(trans('admin.translation.locale_description'));

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(trans('admin.translation.locale_header'));
            $content->description(trans('admin.translation.locale_description'));

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
            $content->header(trans('admin.translation.locale_header'));
            $content->description(trans('admin.translation.locale_description'));

            $content->body($this->form());
        });
    }

    public function grid()
    {
        return Admin::grid(LocaleModel::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->code(trans('admin.translation.locale_code'));
            $grid->name(trans('admin.translation.locale_name'));
            // $grid->created_at();
            // $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', trans('admin.translation.locale_name'));
                $filter->like('code', trans('admin.translation.locale_code'));
            });
        });
    }

    public function form()
    {
        return Admin::form(LocaleModel::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('code', trans('admin.translation.locale_code'))->rules('required');
            $form->text('name', trans('admin.translation.locale_name'))->rules('required');
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}
