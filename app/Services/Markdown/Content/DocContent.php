<?php

namespace App\Services\Markdown\Content;

class DocContent extends AbstractContent
{
    public $title;
    public $date;
    public $content;

    public $fillable = [
        'title', 'date', 'content'
    ];

    public function frameContent()
    {
        return "---
title: __TITLE__
date: __DATE__
---

__CONTENT__

        ";
    }
}
