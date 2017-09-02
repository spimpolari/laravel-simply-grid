<?php
namespace spimpolari\LaravelSimplyGrid\Facades;

use Illuminate\Support\Facades\Facade;

class SimplyGrid extends Facade
{
    protected static function getFacadeAccessor() { return 'simplygrid';}
}