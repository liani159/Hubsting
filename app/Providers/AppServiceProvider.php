<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Folder;
use App\Models\Files;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(
            [
                'folder' => Folder::class,
                'file' => Files::class,
            ]
            );
        //
    }
}
