<?php

namespace App\Actions;

class SavePhotos
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle($pet,  $photos): void
    {
        foreach ($photos as $photo) {
            $fileName = $pet->id . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('pet_photos', $fileName);

            $pet->photos()->create([
                'path' => $path
            ]);
        }
    }

    public static function run(...$arguments, $pet, $photos): void
    {
        (new self(...$arguments))->handle($pet, $photos);
    }
}
