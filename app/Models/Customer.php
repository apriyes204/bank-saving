<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function accounts(){
        return $this->hasMany(Account::class, 'customer', 'id');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
