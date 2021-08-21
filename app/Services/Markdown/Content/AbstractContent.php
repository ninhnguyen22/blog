<?php

namespace App\Services\Markdown\Content;

abstract class AbstractContent
{
    public $fillable = [
    ];

    public function getAttribute($name)
    {
        return property_exists($this, $name) ? $this->{$name} : null;
    }

    abstract public function frameContent();

}
