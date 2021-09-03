<?php

namespace App\Services\Markdown\Contracts;

interface FileGenerateContract
{
    public function toFile($path, $content);

    public function makeDir($path);

    public function removeFile($path);

    public function getPathRoot();
}
