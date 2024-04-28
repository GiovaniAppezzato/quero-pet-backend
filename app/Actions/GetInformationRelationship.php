<?php

namespace App\Actions;

use App\Enums\UserTypeEnum;
use App\Models\Ong;
use App\Models\User;
use App\Models\Adopter;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GetInformationRelationship
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly User $user)
    {}

    public function handle(): HasOne
    {
        switch ($this->user->user_type_id) {
            case UserTypeEnum::ONG->value:
                return $this->user->hasOne(Ong::class);
            case UserTypeEnum::ADOPTER->value:
                return $this->user->hasOne(Adopter::class);
            default:
                return $this->user->hasOne(Admin::class);
        }
    }

    public static function run(...$arguments): HasOne
    {
        return (new self(...$arguments))->handle();
    }
}
