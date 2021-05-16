<?php

namespace Hadefication\Emailia;

use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Hadefication\Emailia\Listeners\Subscriber;
use Hadefication\Emailia\Commands\EmailiaCommand;
use Hadefication\Emailia\Http\Livewire\Index;
use Hadefication\Emailia\Http\Livewire\Message;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EmailiaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('emailia')
            // ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_emailia_table');
    }

    public function packageBooted()
    {
        Livewire::component('emailia', Index::class);
        Livewire::component('emailia-message', Message::class);
    }
}
