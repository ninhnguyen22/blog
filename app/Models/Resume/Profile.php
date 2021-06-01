<?php

namespace App\Models\Resume;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;

    protected $fillable = ['icon', 'name', 'type', 'content_key', 'content_value', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function scopePublic($query)
    {
        return $query->where('active', true);
    }
}
