<?php

namespace App\Services\Markdown;

use App\Services\Markdown\Content\PostContent;
use App\Services\Markdown\Contracts\FileStrategyContract;

class PostFactory extends AbstractFactory
{
    protected $fileStrategy;

    public function __construct(FileStrategyContract $fileStrategy)
    {
        $this->fileStrategy = $fileStrategy;

        parent::__construct($fileStrategy);
    }

    public function setDir()
    {
        $this->fileStrategy->setRootDir('blogs' . DIRECTORY_SEPARATOR . $this->getCategoryDirName($this->model));
    }

    public function getFileName()
    {
        return $this->model->title . '_' . $this->model->id;
    }

    public function getContent()
    {
        $model = $this->model;

        $content = new PostContent();
        $content->title = $model->title;
        $content->author = auth()->user()->name;
        $content->date = $model->updated_at->format('Y-m-d');
        $content->location = 'VN';
        $content->tags = $model->tags->pluck('name');
        $content->categories = [$model->category->name];
        $content->description = $model->preview;
        $content->image = '';
        $content->content = $model->content;
        return $content;
    }

    private function getCategoryDirName($model)
    {
        return $model->category->name;
    }

}
