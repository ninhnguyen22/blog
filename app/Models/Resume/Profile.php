<?php

namespace App\Models\Resume;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;

    protected $fillable = ['type', 'icon', 'name', 'content_key', 'content_value'];

}
