<?php

namespace App\Admin\Repositories;

use App\Admin\Repositories\Interfaces\GistRepositoryInterface;
use App\Admin\Services\Gist\GistApi;
use App\Models\Blog\Gist;
use App\Models\Blog\GistFile;
use Illuminate\Support\Facades\DB;

class GistRepository implements GistRepositoryInterface
{
    /**
     * @var Gist
     */
    protected $gist;

    /**
     * @var GistApi
     */
    protected $gistApi;

    /**
     * @var GistFile
     */
    protected $gistFile;

    public function __construct(
        Gist $gist,
        GistFile $gistFile,
        GistApi $gistApi
    )
    {
        $this->gist = $gist;
        $this->gistFile = $gistFile;
        $this->gistApi = $gistApi;
    }

    public function model()
    {
        return $this->gist;
    }

    public function getAllGist()
    {
        return $this->gistApi->all();
    }

    public function syncAllGist()
    {
        $gists = $this->getAllGist();
            foreach ($gists as $gist) {
            $this->saveDb($gist);
        }
    }

    public function saveDb($re)
    {
        try {
            DB::beginTransaction();
            $gist = $this->saveGist($re);

            // files
            $files = $re->files;
            foreach ($files as $file) {
                $this->saveGistFile($file, $gist->id);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            throw $exception;
        }
    }

    public function saveGist($re)
    {
        $model = $this->model();
        $gist = $model->findByGistId($re->id);
        $gist->setGistId($re->id);
        $gist->setDescription($re->description);
        $gist->setHtmlUrl($re->html_url);
        $gist->setIsPublic($re->public);
        $gist->save();

        return $gist;
    }

    public function saveGistFile($file, $gistId)
    {
        $gistFile = $this->gistFile;
        $gistFile->setGistId($gistId);
        $gistFile->setFileName($file->filename);
        $gistFile->setRawUrl($file->raw_url);
        $rawContent = $this->gistApi->getRawContent($file->raw_url);
        $gistFile->setContent($rawContent);
        $gistFile->save();
        return $gistFile;
    }
}
