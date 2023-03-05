<?php

namespace App\Traits\Models;

trait WithIndexTrait
{
    public function scopeWithIndex($query)
    {
        return $query->with(['User','Comments']);
    }
}
