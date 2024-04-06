<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\WithInformationScope;
use App\Actions\GetInformationRelationship;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new WithInformationScope);
    }

    /**
     * Get the information associated with the User
     */
    public function information(): HasOne
    {
        return (new GetInformationRelationship($this))->handle();
    }

    /**
     * Get the UserType associated with the User
     */
    function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * Get the Ong associated with the User
     */
    public function ong(): HasOne
    {
        return $this->hasOne(Ong::class);
    }

    /**
     * Get the Customer associated with the User
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get the Admin associated with the User
     */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
