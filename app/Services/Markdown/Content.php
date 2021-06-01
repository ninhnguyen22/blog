<?php

namespace App\Services\Markdown;

class Content
{
    protected $title;
    protected $date;
    protected $tags;
    protected $author;
    protected $location;
    protected $content;
    protected $description;
    protected $image;

    public $fillable = [
        'title', 'date', 'tags', 'author', 'location', 'content', 'description', 'image'
    ];

    public function getAttribute($name)
    {
        return property_exists($this, $name) ? $this->{$name} : null;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

}
