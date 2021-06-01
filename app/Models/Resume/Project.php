<?php

namespace App\Models\Resume;

use App\Models\Traits\ScopePublic;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;
    use ScopePublic;

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['title', 'content', 'link', 'image', 'tag', 'color', 'date', 'is_public'];

}
