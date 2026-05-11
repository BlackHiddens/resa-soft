<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function root()
    {
        // API Google désactivée pour l'instant — avis manuels depuis les traductions
        // Pour réactiver : voir App\Services\GoogleReviewsService
        $reviews = [
            ['quote' => __('home.reviews.r1_quote'), 'author' => __('home.reviews.r1_author'), 'meta' => __('home.reviews.r1_meta'), 'avatar' => 'PE', 'rating' => 5],
            ['quote' => __('home.reviews.r2_quote'), 'author' => __('home.reviews.r2_author'), 'meta' => __('home.reviews.r2_meta'), 'avatar' => 'FT', 'rating' => 5],
            ['quote' => __('home.reviews.r3_quote'), 'author' => __('home.reviews.r3_author'), 'meta' => __('home.reviews.r3_meta'), 'avatar' => 'B',  'rating' => 5],
            ['quote' => __('home.reviews.r4_quote'), 'author' => __('home.reviews.r4_author'), 'meta' => __('home.reviews.r4_meta'), 'avatar' => 'CA', 'rating' => 5],
            ['quote' => __('home.reviews.r5_quote'), 'author' => __('home.reviews.r5_author'), 'meta' => __('home.reviews.r5_meta'), 'avatar' => 'VO', 'rating' => 5],
            ['quote' => __('home.reviews.r6_quote'), 'author' => __('home.reviews.r6_author'), 'meta' => __('home.reviews.r6_meta'), 'avatar' => 'MA', 'rating' => 5],
        ];

        return view('site.home', [
            'reviews'         => $reviews,
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
