<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Article extends Component
{
    public $article;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Blog\Article $article
     * @return void
     */
    public function __construct(\App\Models\Blog\Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.article');
    }
}
