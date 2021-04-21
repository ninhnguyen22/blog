<?php

namespace App\Services;

use League\CommonMark\MarkdownConverterInterface;

class MarkdownContent
{
    protected $converter;

    public function __construct(MarkdownConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    public function convertToHtml()
    {
        return $this->converter->convertToHtml('## foo');
    }
}
