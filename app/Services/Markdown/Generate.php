<?php

namespace App\Services\Markdown;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Generate
{
    protected $content;
    protected $contentString;

    const FILE_PATH_PREFIX = [
        'blog', 'blog', '_posts'
    ];

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function setContent(Content $content)
    {
        $this->content = $content;

        return $this;
    }

    public function makeContentString()
    {
        $content = $this->getOrigin();
        foreach ($this->getContentAttributes() as $attribute) {
            $attributeContent = $this->content->getAttribute($attribute);
            if ($attribute === 'tags') {
                $attributeContent = $this->generateTags($attributeContent);
            }
            $keyReplacer = $this->getKeyReplacer($attribute);
            $content = str_replace($keyReplacer, $attributeContent, $content);
        }
        return $content;
    }

    public function generateTags($tags)
    {
        $tagsStr = '';
        foreach ($tags as $tag) {
            $tagsStr .= '  - ' . $tag . "\n";
        }
        return $tagsStr;
    }

    protected function getContentAttributes()
    {
        return $this->content->fillable;
    }

    protected function getKeyReplacer($attribute)
    {
        return '__' . strtoupper($attribute) . '__';
    }

    protected function getOrigin()
    {
        return "---
title: __TITLE__
date: __DATE__
tags:
__TAGS__
author: __AUTHOR__
location: __LOCATION__
description: __DESCRIPTION__
image: __IMAGE__
---

__CONTENT__

        ";
    }

    public function generate($content = null)
    {
        if (!is_null($content)) {
            $this->setContent($content);
        }
        $date = $this->content->getAttribute('date');
        $title = $this->content->getAttribute('title');
        $filePath = $this->getPath($date, $title);
        $oldFile = Session::get('_old_file_name');

        if ($oldFile) {
            $oldPath = $this->concatFilePath($oldFile);
            if ($oldPath !== $filePath && file_exists($oldPath)) {
                unlink($oldPath);
            }
            Session::forget('_old_file_name');
        }

        $this->writeFile($filePath, $this->makeContentString());

    }

    public function getFileName($date, $title)
    {
        return Str::slug($date . '-' . $title) . '.md';
    }

    protected function getPathPrefix()
    {
        return implode(DIRECTORY_SEPARATOR, self::FILE_PATH_PREFIX);
    }

    protected function getPath($date, $title)
    {
        $fileName = $this->getFileName($date, $title);
        return $this->concatFilePath($fileName);
    }

    protected function concatFilePath($fileName)
    {
        return $this->getPathPrefix() . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function writeFile($path, $content)
    {
        $file = fopen($path, "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

}
