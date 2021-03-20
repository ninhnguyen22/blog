<?php

namespace App\User\Layout;

class Head
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $meta = [
        [
            'charset' => 'utf-8'
        ],
        [
            'name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'
        ],
        [
            'http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'
        ],
    ];

    public function __construct($title = null, $meta = [])
    {
        $this->setTitle($title);
        $this->setMeta($meta);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function setTitle($title)
    {
        if (is_null($title)) {
            $title = config('user.name');
        }
        $this->title = $title;
    }

    public function setMeta($meta)
    {
        if (is_array($meta)) {
            foreach ($meta as $tag) {
                if (is_array($tag)) {
                    $this->meta = array_merge($this->meta, $tag);
               } else {
                    $this->meta[] = $tag;
                }
            }
        }
    }
}
