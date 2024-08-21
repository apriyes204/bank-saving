<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\DepositoType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'packet',
        'customer',
        'balance'
    ];

    public function customerFK() {
        return $this->belongsTo(Customer::class, 'customer', 'id');
    }

    public function depositoType() {
        return $this->belongsTo(DepositoType::class, 'packet', 'id');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function calculateFinalBalance($months)
    {
        $monthlyReturn = $this->depositoType->return / 12 / 100;
        return $this->balance * $months * $monthlyReturn;
    }

}
