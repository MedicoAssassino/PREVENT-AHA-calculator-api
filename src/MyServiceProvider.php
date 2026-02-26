<?php

namespace HClean\PreventCalcApi;

use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // سرویس شما اینجا در هسته لاراول ثبت می‌شود
        $this->app->singleton('prevent-calculator', function ($app) {
            return new \HClean\PreventCalcApi\PreventCalculatorApi();
        });
    }

    public function boot()
    {
        // کارهایی که موقع لود شدن پکیج باید انجام شود (اختیاری)
    }
}
