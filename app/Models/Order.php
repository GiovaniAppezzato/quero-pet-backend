<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    protected function casts(): array
    {
        return [
            'canceled_at' => 'datetime',
            'adopted_at' => 'datetime',
        ];
    }

    function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    function ong()
    {
        return $this->belongsTo(Ong::class);
    }
}
