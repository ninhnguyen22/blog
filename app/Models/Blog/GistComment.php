<?php

namespace App\Models\Blog;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GistComment extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
}
