<?php

namespace App\Services\Markdown\Strategies;

use App\Services\Markdown\Contracts\FileStrategyContract;
use App\Services\Markdown\FileGenerate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FileStrategy implements FileStrategyContract
{
    private $rootDir = 'blogs';

    protected $generate;

    public function __construct(FileGenerate $generate)
    {
        $this->generate = $generate;
    }

    public function setRootDir($dir)
    {
        $this->rootDir = $dir;
    }

    public function createFile($path, $content)
    {
        $this->generate->toFile($this->getPathFromRoot($path), $content);
    }

    public function editFile($path, $content)
    {
        $oldFile = $this->getOldFile();

        /* Remove old file */
        if ($oldFile) {
            $this->generate->removeFile($oldFile);
        }

        /* Create new file */
        $this->createFile($path, $content);

        /* Clear */
        $this->clearOldFileTmp();
    }

    public function removeFile($id)
    {
        $search = $this->rootDir . DIRECTORY_SEPARATOR . '*-' . $this->addExtension($id);
        $this->generate->findAndRemove($search);
    }

    private function addExtension($fileName)
    {
        $fileName = Str::slug($fileName);
        return $fileName . '.md';
    }

    private function getPathFromRoot($path)
    {
        return $this->rootDir . DIRECTORY_SEPARATOR . $this->addExtension($path);
    }

    private function getOldFile()
    {
        return Session::get('blog_md_file');
    }

    private function clearOldFileTmp()
    {
        Session::forget('blog_md_file');
    }
}
