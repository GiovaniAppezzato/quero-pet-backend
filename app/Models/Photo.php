<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'pet_id'
    ];

    /**
     * Get the pet that owns the photo.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
