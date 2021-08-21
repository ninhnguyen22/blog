<?php

namespace App\Services\Markdown;

use App\Services\Markdown\Content\DocContent;
use App\Services\Markdown\Contracts\FileStrategyContract;

class DocFactory extends AbstractFactory
{
    protected $fileStrategy;

    public function __construct(FileStrategyContract $fileStrategy)
    {
        $this->fileStrategy = $fileStrategy;

        parent::__construct($fileStrategy);
    }

    public function setDir()
    {
        $this->fileStrategy->setRootDir('docs' . DIRECTORY_SEPARATOR . 'nin');
    }

    public function getFileName()
    {
        return $this->model->title . '_' . $this->model->id;
    }

    public function getContent()
    {
        $model = $this->model;

        $content = new DocContent();
        $content->title = $model->title;
        $content->date = $model->updated_at->format('Y-m-d');
        $content->content = $model->content;
        return $content;
    }

    public function generate()
    {

    }

}
