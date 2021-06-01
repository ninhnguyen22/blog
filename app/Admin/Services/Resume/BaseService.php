<?php

namespace App\Admin\Services\Resume;

use App\Admin\Services\BaseService as AdminBaseService;

class BaseService extends AdminBaseService
{
    protected $outputPrefix = ["portfolio", "data"];

    public function __construct()
    {
        parent::__construct();
    }

    public function convertToJson($entity, $path)
    {
        $json = json_encode($entity);
        $this->writeFile($json, $path);
    }

    protected function writeFile($content, $path)
    {
        $file = fopen($path, "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

    protected function getPath($fileName)
    {
        $paths = $this->outputPrefix;
        $paths[] = $fileName;
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}
