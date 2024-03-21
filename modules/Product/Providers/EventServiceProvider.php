<?php

namespace Modules\Product\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Order\Events\OrderFulfilled;
use Modules\Product\Events\DecreaseProductStock;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderFulfilled::class => [
            DecreaseProductStock::class,
        ]
    ];
}
