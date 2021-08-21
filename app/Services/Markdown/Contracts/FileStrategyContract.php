<?php

namespace App\Services\Markdown\Contracts;

interface FileStrategyContract
{
    public function setRootDir($dir);

    public function createFile($path, $content);

    public function editFile($path, $content);

    public function removeFile($filePath);
}
