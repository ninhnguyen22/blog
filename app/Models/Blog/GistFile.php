<?php

namespace App\Models\Blog;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GistFile extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    public function setFileName($fileName)
    {
        $this->attributes['file_name'] = $fileName;
    }

    public function setRawUrl($url)
    {
        $this->attributes['raw_url'] = $url;
    }

    public function setGistId($id)
    {
        $this->attributes['gist_id'] = $id;
    }

    public function setContent($content)
    {
        $this->attributes['content'] = $content;
    }
}
