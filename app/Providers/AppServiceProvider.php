<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AccessList;
use Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (Request::is('student-information')) {
            view()->composer('student_information.index', function ($view) {
                $view->with('access', \App\AccessList::userCanAccess());
                $view->with('dateToday', \App\Date::dateToday());
                $view->with('dateTodayFull', \App\Date::dateTodayFull());
                $view->with('school_year', \App\Date::getCurrentSchoolYear());
                $view->with('semester', \App\Date::getCurrentSemester());
                $view->with('allYears', \App\Year::allYears());
                $view->with('user', \App\User::userInfo());
                $view->with('station', \App\QueueStation::station());
            });
        } else {
            view()->composer('*.index', function ($view) {
                $view->with('access', \App\AccessList::userCanAccess());
                $view->with('dateToday', \App\Date::dateToday());
                $view->with('dateTodayFull', \App\Date::dateTodayFull());
                $view->with('school_year', \App\Date::getCurrentSchoolYear());
                $view->with('semester', \App\Date::getCurrentSemester());
                $view->with('allYears', \App\Year::allYears());
                $view->with('user', \App\User::userInfo());
                $view->with('station', \App\QueueStation::station());
            });
        }

        
        

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if ($this->app->isLocal()) {
        //     $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        // }
    }
}
