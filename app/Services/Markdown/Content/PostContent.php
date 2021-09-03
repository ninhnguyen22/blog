<?php

namespace App\Services\Markdown\Content;

class PostContent extends AbstractContent
{
    public $title;
    public $date;
    public $tags;
    public $author;
    public $location;
    public $content;
    public $description;
    public $image;
    public $categories;

    public $fillable = [
        'title', 'date', 'tags', 'author', 'location', 'content', 'description', 'image', 'categories'
    ];

    public function frameContent()
    {
        return "---
title: __TITLE__
date: __DATE__
tags:
__TAGS__
categories:
__CATEGORIES__
author: __AUTHOR__
location: __LOCATION__
description: __DESCRIPTION__
image: __IMAGE__
---

__CONTENT__

        ";
    }
}
