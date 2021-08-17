<?php

namespace App\Models\Blog;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    public function setGistId($gistId)
    {
        $this->attributes['gist_id'] = $gistId;
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function setHtmlUrl($url)
    {
        $this->attributes['html_url'] = $url;
    }

    public function setIsPublic($isPublic)
    {
        $this->attributes['is_public'] = $isPublic;
    }

    public function gistFiles()
    {
        return $this->hasMany(GistFile::class);
    }

    public function findByGistId($gistId)
    {
        $gist = $this
            ->where('gist_id', $gistId)
            ->first();
        return $gist ?: $this;
    }
}
