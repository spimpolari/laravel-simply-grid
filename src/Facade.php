<?php
namespace spimpolari\LaravelSimplyGrid;

use spimpolari\LaravelSimplyGrid\Support\SimplyGrid;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor() { return  SimplyGrid::class ;}
}