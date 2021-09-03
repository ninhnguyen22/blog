<?php

namespace App\Services\Markdown;

use App\Services\Markdown\Contracts\FileStrategyContract;

abstract class AbstractFactory
{
    protected $fileStrategy;

    protected $model;

    public function __construct(FileStrategyContract $fileStrategy)
    {
        $this->fileStrategy = $fileStrategy;
    }

    abstract public function getContent();

    abstract public function setDir();

    abstract public function getFileName();

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function generate()
    {
        $this->setDir();
        $this->fileStrategy->createFile($this->getFileName(), $this->makeContentString());
    }

    public function removeOldFile($id)
    {
        $this->setDir();
        $this->fileStrategy->removeFile($id);
    }

    public function makeContentString()
    {
        $content = $this->getContent();
        $frameContent = $content->frameContent();
        $fillable = $content->fillable;

        /* Replace Common */
        foreach ($this->commonContentReplacer() as $cKeyReplacer => $cReplacer)
        {
            $frameContent = str_replace($cKeyReplacer, $cReplacer, $frameContent);
        }

        /* Replace content attribute */
        foreach ($fillable as $attribute) {
            $attributeContent = $content->getAttribute($attribute);

            if ($attribute === 'tags' || $attribute === "categories") {
                $attributeContent = $this->generateMultiple($attributeContent);
            }

            $keyReplacer = $this->getKeyReplacer($attribute);
            $frameContent = str_replace($keyReplacer, $attributeContent, $frameContent);
        }

        return $frameContent;
    }

    public function generateMultiple($targets)
    {
        $str = '';
        foreach ($targets as $target) {
            $str .= '  - ' . $target . "\n";
        }
        return $str;
    }

    protected function getKeyReplacer($attribute)
    {
        return '__' . strtoupper($attribute) . '__';
    }

    protected function commonContentReplacer()
    {
        return [
            'http://ncore.local/storage/blog/articles' => 'https://ninhnguyen22.github.io/blog/assets/img/articles'
        ];
    }

}
