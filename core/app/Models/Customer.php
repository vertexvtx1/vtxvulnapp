<?php

namespace App\Models;

use App\Traits\ActionTakenBy;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Searchable, ActionTakenBy;

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function saleReturns()
    {
        return $this->hasMany(SaleReturn::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function totalSaleReturnDueAmount()
    {
        return $this->sale->sum('due_amount');
    }

    public function totalSaleDueAmount()
    {
        return $this->saleReturns->sum('due_amount');
    }

    function  totalReceivableAmount()
    {
        $saleAmount   = $this->sale->where('due_amount', '>', 0)->sum('due_amount');
        $returnAmount = $this->saleReturns->where('due_amount', '<', 0)->sum('due_amount');
        return $saleAmount + abs($returnAmount);
    }

    function totalPayableAmount()
    {
        $saleAmount = $this->sale->where('due_amount', '<', 0)->sum('due_amount');

        $returnAmount   = $this->saleReturns->where('due_amount', '>', 0)->sum('due_amount');
        return abs($saleAmount) + $returnAmount;
    }
}
