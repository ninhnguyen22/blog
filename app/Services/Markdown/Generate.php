<?php

namespace App\Services\Markdown;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Generate
{
    protected $content;
    protected $contentString;

    const FILE_PATH_PREFIX = [
        'blog', 'blogs'
    ];

    const DOC_FILE_PATH_PREFIX = [
        'blog', 'docs', 'nin'
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

    public function makeContentString($isDoc = false)
    {
        $content = $isDoc ? $this->getDocOrigin() : $this->getOrigin();

        foreach ($this->getContentAttributes() as $attribute) {
            $attributeContent = $this->content->getAttribute($attribute);
            if ($attribute === 'tags' || $attribute === "categories") {
                $attributeContent = $this->generateMultiple($attributeContent);
            }
            $keyReplacer = $this->getKeyReplacer($attribute);
            $content = str_replace($keyReplacer, $attributeContent, $content);
        }
        return $content;
    }

    public function generateMultiple($targets)
    {
        $str = '';
        foreach ($targets as $target) {
            $str .= '  - ' . $target . "\n";
        }
        return $str;
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

    protected function getDocOrigin()
    {
        return "---
title: __TITLE__
date: __DATE__
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
        $categories = $this->content->getAttribute('categories');
        $filePath = $this->getPath($date, $title, $categories);
        
        $this->writeFile($filePath, $this->makeContentString());
    }

    public function docGenerate($content = null)
    {
        if (!is_null($content)) {
            $this->setContent($content);
        }
        $date = $this->content->getAttribute('date');
        $title = $this->content->getAttribute('title');
        $filePath = $this->getPath($date, $title, ['doc']);

        $this->writeFile($filePath, $this->makeContentString(true));
    }

    public function getFileName($title)
    {
        return Str::slug($title) . '.md';
    }

    protected function getPathPrefix()
    {
        return implode(DIRECTORY_SEPARATOR, self::FILE_PATH_PREFIX);
    }

    protected function getDocPathPrefix()
    {
        return implode(DIRECTORY_SEPARATOR, self::DOC_FILE_PATH_PREFIX);
    }

    protected function getPath($date, $title, $categories)
    {
        $fileName = $this->getFileName($title);
        return $this->concatFilePath($fileName, $categories);
    }

    protected function concatFilePath($fileName, $categories)
    {
        if (empty($categories)) {
            return $this->getPathPrefix() . DIRECTORY_SEPARATOR . $fileName;
        }

        if ($categories[0] === 'doc') {
            $this->makeDir($this->getDocPathPrefix());
            return $this->getDocPathPrefix() . DIRECTORY_SEPARATOR . $fileName;
        }

        $category = $categories[0];
        $this->makeDir($this->getPathPrefix() . DIRECTORY_SEPARATOR . $category);
        return $this->getPathPrefix() . DIRECTORY_SEPARATOR . $category . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function writeFile($path, $content)
    {
        $file = fopen($path, "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

    protected function makeDir($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }

}
