<?php

namespace App\Admin\Services\Blog;

use App\Models\Blog\Article;
use App\Services\MarkdownContent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ArticleService extends BaseService
{
    /**
     * @var Article
     */
    protected $articleModel;

    /**
     * @var MarkdownContent
     */
    protected $markdownContent;

    public function __construct(Article $article, MarkdownContent $markdownContent)
    {
        parent::__construct();

        $this->articleModel = $article;
        $this->markdownContent = $markdownContent;
    }

    /**
     * @return Article
     */
    public function getModel()
    {
        return $this->articleModel;
    }

    /**
     * @return MarkdownContent
     */
    public function getConverter()
    {
        $a = $this->markdownContent->convertToHtml('## ds');
        dd($this->markdownContent);
        return $this->markdownContent;
    }

    public function getOptionsForStatusInput()
    {
        $model = $this->articleModel;
        return [
            $model::STATUS_DRAFT => 'Draft',
            $model::STATUS_PRIVATE => 'Private',
            $model::STATUS_PROTECTED => 'Protected',
            $model::STATUS_PUBLIC => 'Public',
            $model::STATUS_RECYCLE => 'Recycle',
        ];
    }

    public function prepareDataForInput()
    {
        // User
        request()->merge(['user_id' => auth('admin')->id()]);
    }

    /**
     * @return array|Collection
     */
    public function getOptionsForTagInput()
    {
        $id = request('article');
        if (!is_null($id)) {
            $article = $this->articleModel->find($id);
            return $article->tags()->pluck('name', 'id');
        }
        return [];
    }

    public static function getGenerateUrl($id, $slug, $view = false)
    {
        $generate = $view ? '' : '?generate=1';

        return route('blog.detail', ['slug' => Str::slug($slug), 'id' => $id]) . $generate;
    }

}
