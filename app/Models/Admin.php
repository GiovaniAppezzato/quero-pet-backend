<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'created_by',
    ];

    /**
     * Get the user that owns the Admin
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin that created the Admin
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
