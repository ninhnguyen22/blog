<?php

namespace App\Models\Resume;

use App\Models\Traits\ScopePublic;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;
    use ScopePublic;

    protected $fillable = ['name', 'level', 'time', 'is_public'];

    protected $casts = [
        'is_public' => 'boolean'
    ];
}
