<?php

namespace App\Admin\Controllers;

use App\Models\Topic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TopicsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '话题';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic());

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'))->width(200);
        $grid->column('body', __('内容'))->width(300);
        // $grid->column('user_id', __('User id'));
        $grid->column('user_id', __('用户名'))->display(function ($user_id){
            $user_name = Topic::find($user_id)->user->name;
            return $user_name;
        });
        $grid->column('category_id', __('分类'))->display(function ($category_id){
            $category_name = Topic::find($category_id)->category->name;
            return $category_name;
        });
        $grid->column('reply_count', __('评论数'));
        $grid->column('created_at', __('创建事件'));
        $grid->column('updated_at', __('更新时间'));
        // $grid->column('view_count', __('View count'));
        // $grid->column('last_reply_user_id', __('Last reply user id'));
        // $grid->column('order', __('Order'));
        // $grid->column('excerpt', __('Excerpt'));
        // $grid->column('slug', __('Slug'));


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
        $show = new Show(Topic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('body', __('Body'));
        $show->field('user_id', __('User id'));
        $show->field('category_id', __('Category id'));
        $show->field('reply_count', __('Reply count'));
        $show->field('view_count', __('View count'));
        $show->field('last_reply_user_id', __('Last reply user id'));
        $show->field('order', __('Order'));
        $show->field('excerpt', __('Excerpt'));
        $show->field('slug', __('Slug'));
        $show->field('title', __('Title'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topic());

        $form->textarea('body', __('Body'));
        $form->number('user_id', __('User id'));
        $form->number('category_id', __('Category id'));
        $form->number('reply_count', __('Reply count'));
        $form->number('view_count', __('View count'));
        $form->number('last_reply_user_id', __('Last reply user id'));
        $form->number('order', __('Order'));
        $form->textarea('excerpt', __('Excerpt'));
        $form->text('slug', __('Slug'));
        $form->text('title', __('Title'));

        return $form;
    }
}
