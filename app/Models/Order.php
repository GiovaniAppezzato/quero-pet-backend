<?php

namespace App\Models;

use App\Models\Adopter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    function adopter()
    {
        return $this->belongsTo(Adopter::class);
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
