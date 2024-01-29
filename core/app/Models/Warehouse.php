<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use Searchable, GlobalStatus;

    public function productStock()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function stock()
    {
        return $this->productStock()->sum('quantity');
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeDeactivate()
    {
        return $this->where('status', 0);
    }
}