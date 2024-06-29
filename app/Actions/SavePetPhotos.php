<?php

namespace App\Actions;

use Illuminate\Support\Str;

class SavePetPhotos
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {}

    public function handle($pet, $photos): void
    {
        $photosToBeInserted = [];

        foreach ($photos as $photo) {
            $timestamp = now()->timestamp;
            $hash = hash('sha256', $timestamp . Str::random(10));
            $extension = $photo->getClientOriginalExtension();
            $filename = $hash . '.' . $extension;
            $path = $photo->file('pet_photo')->storeAs('pet_photos', $filename);
            array_push($photosToBeInserted, ['path' => $path]);
        }

        $pet->photos()->insert($photosToBeInserted);
    }

    public static function run(...$arguments): void
    {
        (new self(...$arguments))->handle();
    }
}
