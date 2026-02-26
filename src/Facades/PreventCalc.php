<?php

namespace HClean\PreventCalcApi\Facades;

use Illuminate\Support\Facades\Facade;

class PreventCalc extends Facade
{
    protected static function getFacadeAccessor()
    {
        
        return 'prevent-calculator'; 
    }
}
