<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

Admin::css('/vendor/laravel-admin/cus/_cus.css');
Admin::css('/vendor/laravel-admin/cus/bootstrap-markdown-editor.css');
Admin::js('/vendor/laravel-admin/cus/_convert_slug.js?v=' . time());
Admin::js('https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js');
Admin::js('https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js');
Admin::js('/vendor/laravel-admin/cus/bootstrap-markdown-editor.js');
Admin::js('/vendor/laravel-admin/cus/_cus.js?v=' . time());
