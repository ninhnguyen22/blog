<?php

namespace App\View\Components\Article;

use Illuminate\View\Component;

class Author extends Component
{
    public $authorName;
    public $authorAvatar;
    public $publishedAt;

    /**
     * Create a new component instance.
     *
     * @param string $authorName
     * @param string $authorAvatar
     * @param string $publishedAt
     * @return void
     */
    public function __construct($authorName, $authorAvatar, $publishedAt)
    {
        $this->authorName = $authorName;
        $this->authorAvatar = $authorAvatar;
        $this->publishedAt = $publishedAt->format('Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.article.author');
    }
}
