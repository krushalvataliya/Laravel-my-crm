<?php

namespace Kv\MyCrm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kv\MyCrm\LaravelCrm
 */
class LaravelCrmFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-crm';
    }
}
