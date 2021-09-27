<?php

namespace AwStudio\Address;

use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations'),
        ], 'address:migrations');

        $this->publishes([
            __DIR__.'/../models' => app_path('Models'),
        ], 'address:models');
    }
}
