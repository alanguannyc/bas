<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public static function ApplicationOn()
    {
        $setting = \App\Setting::find(1);
        if ($setting) {
            $setting->application_on = true;
            $setting->save();
        } else {
            $setting = \App\Setting::create([
                "application_on" => 1
            ]);
        }
    }

    public static function ApplicationOff()
    {
        
        $setting = \App\Setting::find(1);
        if ($setting) {
            $setting->application_on = false;
            $setting->save();
        } else {
            $setting = \App\Setting::create([
                "application_on" => 0
            ]);
        }
        
    }

    public static function Update(Request $request)
    {
        // dd($request->all());
        $setting = \App\Setting::updateOrCreate(['id' => 1], $request->all());

    }

    public static function All()
    {
        
        $setting = \App\Setting::find(1);
        // if ($setting->application_on){
        //     $setting->application_on=true;
        // } else{
        //     $setting->application_on=false;
        // }
        return $setting;
        
    }
}
