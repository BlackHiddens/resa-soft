<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleReviewsService;

class RoutingController extends Controller
{
    public function root(GoogleReviewsService $reviews)
    {
        return view('site.home', [
            'reviews'         => $reviews->getReviews(),
            'googleReviewUrl' => config('services.google.review_url'),
        ]);
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
