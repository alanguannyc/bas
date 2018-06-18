<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    Schema::defaultStringLength(191);
         \App\Role::firstOrCreate(['name'=>'admin']);
        \App\Role::firstOrCreate(['name'=>'member']);
        \App\Role::firstOrCreate(['name'=>'judge']);

        $members = \DB::table('users')->count();
        $memberIncrease = \DB::table('users')->where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())
        ->count();
        $hotels = \DB::table('profiles')->groupBy('company')->count();
        $hotelIncrease = \DB::table('profiles')->where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())
        ->count();
        $nominations = \DB::table('nominations')->count();
        $nominationIncrease = \DB::table('nominations')->where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())
        ->count();

        View::share(['members'=>$members,'hotels'=>$hotels,'nominations'=>$nominations, 'memberIncrease'=>$memberIncrease, 'hotelIncrease'=>$hotelIncrease, 'nominationIncrease'=>$nominationIncrease]);
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
