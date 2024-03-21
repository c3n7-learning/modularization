<?php

namespace Modules\Order\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Order\Events\OrderFulfilled;
use Modules\Order\Events\SendOrderConfirmationEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderFulfilled::class => [
            SendOrderConfirmationEmail::class,
        ]
    ];
}
