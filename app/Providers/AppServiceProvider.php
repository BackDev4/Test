<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use App\Decorators\LoggingEventDispatcherDecorator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventDispatcherInterface::class, function ($app) {
            $eventDispatcher = $app->make(\Illuminate\Contracts\Events\Dispatcher::class);

            $logger = $app->make(LoggerInterface::class);

            return new LoggingEventDispatcherDecorator($eventDispatcher, $logger);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
