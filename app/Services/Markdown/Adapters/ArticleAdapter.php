<?php

namespace App\Services\Markdown\Adapters;

use App\Services\Markdown\Contracts\FileStrategyContract;
use App\Services\Markdown\DocFactory;
use App\Services\Markdown\FileGenerate;
use App\Services\Markdown\PostFactory;
use App\Services\Markdown\Strategies\FileStrategy;

class ArticleAdapter extends Adapter
{
    private $_article;

    public function __construct($model)
    {
        $this->_article = $model;
    }

    public function handle()
    {
        $factory = $this->resolvedMdFactory();
        $factory->setModel($this->_article);
        $this->preProcessor($factory, $this->_article);
        $factory->generate();
    }

    public function resolvedMdFactory()
    {
        $article = $this->_article;
        $category = $article->category->name;
        switch ($category) {
            case 'Doc' :
                return app(DocFactory::class);

            default:
                return app(PostFactory::class);
        }
    }

    private function preProcessor($factory, $model)
    {
        if (!$model->wasRecentlyCreated) {
            $changes = $model->getChanges();
            if (isset($changes['title'])) {
                $factory->removeOldFile($model->id);
            }
        }
    }
}
