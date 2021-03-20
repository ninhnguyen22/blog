<?php

namespace App\User\Services;

use App\Models\Blog\Article;
use App\User\Services\Article\ArticleCondition;

class HomeService
{
    /**
     * @var Article
     */
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticleList(ArticleCondition $articleCondition)
    {
        $articles = $this->article
            ->with('category');
        if ($articleCondition->getCategoryId()) {
            $articles->where('category_id', $articleCondition->getCategoryId());
        }

        return $articles
            ->orderBy('updated_at', 'DESC')
            ->paginate(1);
    }

    public function getArticleDetail($id)
    {
        return $this->article
            ->findOrfail($id);
    }
}
