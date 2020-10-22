<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('用户名'));
        $grid->column('email', __('邮箱'));
        /*
         * display() 方法接受一个匿名函数作为参数，
         * 在展示时会把对应字段值当成参数传给匿名函数，把匿名函数的返回值作为页面输出的内容
         */
        $grid->column('email_verified_at', __('已验证邮箱'))->display(function ($value){
            return $value ? '是' : '否';
        });
        // $grid->column('password', __('Password'));
        // $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('创建时间'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('avatar', __('Avatar'));
        // $grid->column('introduction', __('Introduction'));
        // $grid->column('notification_count', __('Notification count'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('avatar', __('Avatar'));
        $show->field('introduction', __('Introduction'));
        $show->field('notification_count', __('Notification count'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->image('avatar', __('Avatar'));
        $form->text('introduction', __('Introduction'));
        $form->number('notification_count', __('Notification count'));

        return $form;
    }
}
