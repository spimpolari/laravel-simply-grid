<?php
namespace spimpolari\LaravelSimplyGrid\Facades;



class SimplyGrid extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor() { return  \spimpolari\LaravelSimplyGrid\Support\SimplyGrid::class ;}
}