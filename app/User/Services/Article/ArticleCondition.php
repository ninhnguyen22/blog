<?php

namespace App\User\Services\Article;

class ArticleCondition
{
    protected $categoryId;

    protected $categorySlug;

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    public function setCategory($id, $slug = null)
    {
        $this->categoryId = $id;
        $this->categorySlug = $slug;
        return $this;
    }

}
