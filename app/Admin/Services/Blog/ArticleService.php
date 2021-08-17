<?php

namespace App\Admin\Services\Blog;

use App\Models\Blog\Article;
use App\Services\Markdown\Content;
use App\Services\Markdown\Generate as MarkdownGenerate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

class ArticleService extends BaseService
{
    /**
     * @var Article
     */
    protected $articleModel;

    /**
     * @var MarkdownGenerate
     */
    protected $markdownGenerate;

    public function __construct(Article $article, MarkdownGenerate $generate)
    {
        parent::__construct();

        $this->articleModel = $article;
        $this->markdownGenerate = $generate;
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

    /**
     * @param $model
     */
    public function generate($model)
    {
        $content = new Content();

        $tags = $model->tags->pluck('name');
        $category = $model->category->name;
        $date = $model->updated_at->format('Y-m-d');
        if ($model->publish_at) {
            $date = $model->publish_at->format('Y-m-d');
        }

        $content->setTitle($model->title)
            ->setAuthor(auth()->user()->name)
            ->setDate($date)
            ->setLocation('VN')
            ->setTags($tags)
            ->setCategories([$category])
            ->setDescription($model->preview)
            ->setImage('')
            ->setContent($model->content);

        if ($category === 'Doc') {
            $this->markdownGenerate->docGenerate($content);
        } else {
            $this->markdownGenerate->generate($content);
        }
    }

    public function generateFileName($title)
    {
        $oldFileName = $this->markdownGenerate->getFileName($title);
        Session::put('_old_file_name', $oldFileName);
    }

}
