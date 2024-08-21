<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'account_id',
        'status',
        'amount',
        'transactions_date', // Sesuaikan nama kolom dengan tabel
    ];
    
    public function customer() {
        return $this->belongsTo(Customer::class, 'id');
    }

    public function account() {
        return $this->belongsTo(Account::class, 'id');
    }

}
