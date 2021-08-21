<?php

namespace App\Services\Markdown;

use App\Services\Markdown\Contracts\FileGenerateContract;

class FileGenerate implements FileGenerateContract
{
    private $pathRoot = 'blog';

    public function toFile($path, $content)
    {
        // foo/bar/foo.md
        $dirArr = explode(DIRECTORY_SEPARATOR, $path);
        $fileName = array_pop($dirArr);
        $dirPath = $this->_getDirPath($dirArr);
        $this->_writeFile($this->_mergePath($dirPath, $fileName), $content);
    }

    public function makeDir($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }

    public function findAndRemove($search)
    {
        $search = $this->getPathRoot() . DIRECTORY_SEPARATOR . $search;
        foreach (glob($search) as $file) {
            unlink($file);
        }
    }

    public function removeFile($path)
    {
        $filePath = $this->getPathRoot() . DIRECTORY_SEPARATOR . $path;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function getPathRoot()
    {
        return public_path($this->pathRoot);
    }

    private function _mergePath($pathOrigin, $path)
    {
        return $pathOrigin . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * @param array $dirArr
     * @return string
     */
    private function _getDirPath($dirArr)
    {
        $mergeDir = $this->getPathRoot();
        foreach ($dirArr as $dir) {
            $mergeDir = $this->_mergePath($mergeDir, $dir);
            $this->makeDir($mergeDir);
        }
        return $mergeDir;
    }

    private function _writeFile($path, $content)
    {
        $file = fopen($path, "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

}
