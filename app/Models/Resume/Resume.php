<?php

namespace App\Models\Resume;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;

    protected $fillable = ['name', 'active'];

}
