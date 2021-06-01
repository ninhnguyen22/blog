<?php

namespace App\Models\Resume;

use App\Models\Traits\ScopePublic;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;
    use ScopePublic;

    protected $casts = [
        'from' => 'datetime:Y-m-d',
        'to' => 'datetime:Y-m-d'
    ];

    protected $fillable = ['from', 'to', 'title', 'content', 'is_public'];


}
