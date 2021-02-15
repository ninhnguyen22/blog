<?php

namespace App\Models\Blog;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;

    protected $fillable = ['name', 'slug'];
}
