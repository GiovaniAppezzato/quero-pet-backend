<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'breed',
        'age',
        'weight',
        'color',
        'sex',
        'birth_date',
        'is_vaccinated',
        'ong_id',
        'category_id'
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
            'is_vaccinated' => 'boolean',
        ];
    }

    /**
     * Get the category that owns the pet.
     */
    public function ong()
    {
        return $this->belongsTo(Ong::class);
    }

    /**
     * Get the category that owns the pet.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the photos for the pet.
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
