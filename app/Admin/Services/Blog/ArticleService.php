<?php

namespace App\Admin\Services\Blog;

use App\Models\Blog\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ArticleService extends BaseService
{
    /**
     * @var Article
     */
    protected $articleModel;

    public function __construct(Article $article)
    {
        parent::__construct();

        $this->articleModel = $article;
    }

    /**
     * @return Article
     */
    public function getModel()
    {
        return $this->articleModel;
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

    public static function getGenerateUrl($id, $slug)
    {
        $slug = Str::slug($slug);

        $dir = config('user.generate.output.base') . DIRECTORY_SEPARATOR . config('user.generate.output.articles');
        $filePath = $dir . DIRECTORY_SEPARATOR . $slug . '-' . $id . '.html';
        return route('article', ['slug' => $slug, 'id' => $id]) . '?generate=' . $filePath;
    }

}
