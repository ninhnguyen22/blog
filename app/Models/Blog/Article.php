<?php

namespace App\Models\Blog;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use DefaultDatetimeFormat;
    use HasFactory;

    // Status
    const STATUS_DRAFT = 1;
    const STATUS_PRIVATE = 2;
    const STATUS_PROTECTED = 3;
    const STATUS_PUBLIC = 4;
    const STATUS_RECYCLE = 5;

    protected $fillable = ['category_id', 'title', 'preview', 'content', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', self::STATUS_RECYCLE);
    }

}
