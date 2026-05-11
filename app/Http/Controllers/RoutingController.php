<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function root()
    {
        return view('site.home');
    }

    public function privacy()
    {
        app()->setLocale('fr');
        return view('site.privacy');
    }

    public function privacyEn()
    {
        app()->setLocale('en');
        return view('site.privacy');
    }

    /**
     * second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {
        return view($first . '.' . $second);
    }

    /**
     * third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        return view($first . '.' . $second . '.' . $third);
    }
}
