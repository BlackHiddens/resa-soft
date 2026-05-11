<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewsService
{
    /** Cache key principal (succès) */
    private const CACHE_KEY      = 'google_reviews';

    /** Cache key "quota/erreur" : évite de ré-appeler l'API trop vite en cas d'échec */
    private const CACHE_FAIL_KEY = 'google_reviews_failed';

    /** Durée de cache en cas de succès : 24h */
    private const TTL_SUCCESS = 60 * 60 * 24;

    /** Durée de cache en cas d'échec : 1h (évite de spammer l'API) */
    private const TTL_FAIL = 60 * 60;

    /**
     * Retourne les avis : depuis le cache, depuis l'API, ou en fallback manuel.
     * Chaque avis a les clés : quote, author, meta, avatar, rating.
     */
    public function getReviews(): array
    {
        // 1. Déjà en cache (succès précédent) ?
        if (Cache::has(self::CACHE_KEY)) {
            return Cache::get(self::CACHE_KEY);
        }

        // 2. API récemment en échec → fallback direct
        if (Cache::has(self::CACHE_FAIL_KEY)) {
            return $this->getFallbackReviews();
        }

        // 3. Essayer l'API
        $apiKey  = config('services.google.places_api_key');
        $placeId = config('services.google.place_id');

        if ($apiKey && $placeId) {
            $reviews = $this->fetchFromApi($apiKey, $placeId);

            if ($reviews !== null) {
                Cache::put(self::CACHE_KEY, $reviews, self::TTL_SUCCESS);
                return $reviews;
            }

            // Échec : on met un verrou pour 1h
            Cache::put(self::CACHE_FAIL_KEY, true, self::TTL_FAIL);
        }

        return $this->getFallbackReviews();
    }

    /** Force le rechargement depuis l'API au prochain appel */
    public function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_FAIL_KEY);
    }

    // ──────────────────────────────────────────────────────────────────────────

    private function fetchFromApi(string $apiKey, string $placeId): ?array
    {
        try {
            $response = Http::timeout(8)->get(
                'https://maps.googleapis.com/maps/api/place/details/json',
                [
                    'place_id' => $placeId,
                    'fields'   => 'reviews',
                    'language' => app()->getLocale() === 'en' ? 'en' : 'fr',
                    'key'      => $apiKey,
                ]
            );

            if ($response->failed()) {
                Log::warning('GoogleReviews: API HTTP error', ['status' => $response->status()]);
                return null;
            }

            $data = $response->json();

            if (($data['status'] ?? '') !== 'OK') {
                Log::warning('GoogleReviews: API status ' . ($data['status'] ?? 'UNKNOWN'));
                return null;
            }

            $raw = $data['result']['reviews'] ?? [];
            if (empty($raw)) return null;

            return array_map([$this, 'mapReview'], $raw);

        } catch (\Throwable $e) {
            Log::error('GoogleReviews: exception ' . $e->getMessage());
            return null;
        }
    }

    private function mapReview(array $r): array
    {
        $name   = $r['author_name'] ?? 'Anonyme';
        $words  = preg_split('/\s+/', trim($name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        }

        $stars = (int) ($r['rating'] ?? 5);
        $meta  = ($r['relative_time_description'] ?? '') . ' · Google ';
        $meta .= str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);

        return [
            'quote'  => $r['text']    ?? '',
            'author' => $name,
            'meta'   => trim($meta),
            'avatar' => $initials ?: '?',
            'rating' => $stars,
            'source' => 'google',
        ];
    }

    // ──────────────────────────────────────────────────────────────────────────

    /** Avis codés en dur — utilisés si l'API n'est pas configurée ou en échec */
    private function getFallbackReviews(): array
    {
        $locale = app()->getLocale();

        return [
            [
                'quote'  => __('home.reviews.r1_quote'),
                'author' => __('home.reviews.r1_author'),
                'meta'   => __('home.reviews.r1_meta'),
                'avatar' => 'PE',
                'rating' => 5,
                'source' => 'manual',
            ],
            [
                'quote'  => __('home.reviews.r2_quote'),
                'author' => __('home.reviews.r2_author'),
                'meta'   => __('home.reviews.r2_meta'),
                'avatar' => 'FT',
                'rating' => 5,
                'source' => 'manual',
            ],
            [
                'quote'  => __('home.reviews.r3_quote'),
                'author' => __('home.reviews.r3_author'),
                'meta'   => __('home.reviews.r3_meta'),
                'avatar' => 'B',
                'rating' => 5,
                'source' => 'manual',
            ],
            [
                'quote'  => __('home.reviews.r4_quote'),
                'author' => __('home.reviews.r4_author'),
                'meta'   => __('home.reviews.r4_meta'),
                'avatar' => 'CA',
                'rating' => 5,
                'source' => 'manual',
            ],
            [
                'quote'  => __('home.reviews.r5_quote'),
                'author' => __('home.reviews.r5_author'),
                'meta'   => __('home.reviews.r5_meta'),
                'avatar' => 'VO',
                'rating' => 5,
                'source' => 'manual',
            ],
            [
                'quote'  => __('home.reviews.r6_quote'),
                'author' => __('home.reviews.r6_author'),
                'meta'   => __('home.reviews.r6_meta'),
                'avatar' => 'MA',
                'rating' => 5,
                'source' => 'manual',
            ],
        ];
    }
}
