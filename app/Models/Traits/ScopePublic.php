<?php

namespace App\Models\Traits;

trait ScopePublic
{
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }
}
