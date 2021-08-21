<?php

namespace App\Services\Markdown\Contracts;

interface ContentStrategyContract
{
    public function getContent();

    public function setContent($content);
}
