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

    public function handle(): void
    {
        //
    }

    public static function run(...$arguments): void
    {
        (new self(...$arguments))->handle();
    }
}
