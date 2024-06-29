<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\InformationResource;
use App\Http\Resources\OngResource;
use App\Http\Resources\AdopterResource;
use App\Http\Resources\AdminResource;
use App\Enums\UserTypeEnum;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        switch ($this->user_type_id) {
            case UserTypeEnum::ADMIN->value:
                $informationResource = new AdminResource($this->information);
                break;
            case UserTypeEnum::ONG->value:
                $informationResource = new OngResource($this->information);
                break;
            case UserTypeEnum::ADOPTER->value:
                $informationResource = new AdopterResource($this->information);
                break;
            default:
                $informationResource = new InformationResource($this->information);
                break;
        }

        return [
            'id' => $this->id,
            'email' => $this->email,
            'user_type_id' => $this->user_type_id,
            'information' => $informationResource
        ];
    }
}
