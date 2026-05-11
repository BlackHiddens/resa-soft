@extends('layouts.base')

@php
    $brandLogo = asset('images/logo-28degres.jpg');
    $locale    = app()->getLocale();
@endphp

@section('title', __('home.privacy.page_title'))
@section('meta_description'){{ __('home.privacy.meta_desc') }}@endsection

@section('head-extra')
<script>document.documentElement.setAttribute('data-bs-theme','light');</script>
<link rel="canonical" href="{{ $locale === 'en' ? 'https://www.28degresmylife.com/en/privacy-policy' : 'https://www.28degresmylife.com/politique-confidentialite' }}">
<link rel="alternate" hreflang="fr"        href="https://www.28degresmylife.com/politique-confidentialite">
<link rel="alternate" hreflang="en"        href="https://www.28degresmylife.com/en/privacy-policy">
<link rel="alternate" hreflang="x-default" href="https://www.28degresmylife.com/politique-confidentialite">
<meta name="robots" content="noindex, follow">
@endsection

@section('header')
    <nav class="navbar navbar-28 navbar-expand-lg scrolled" id="mainNav" style="position:relative;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('root') }}">
                <img src="{{ $brandLogo }}" alt="Logo 28 Degrés My Life" class="brand-logo">
                <span class="brand-name">28 Degrés My Life</span>
            </a>
            <div class="ms-auto">
                <a href="{{ route('root') }}" class="btn btn-outline-secondary btn-sm">
                    {{ __('home.privacy.back') }}
                </a>
            </div>
        </div>
    </nav>
@endsection

@section('content')
<main>
    <section class="policy-section">
        <div class="container">

            <div class="policy-card" data-aos="fade-up">
                <div class="policy-card__header">
                    <h1>{{ __('home.privacy.title') }}</h1>
                    <p class="lead">{{ __('home.privacy.subtitle') }}</p>
                    <p class="text-muted small">{{ __('home.privacy.last_updated') }}</p>
                </div>

                <div class="policy-card__body">

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s1_title') }}</h2>
                        <p>{{ __('home.privacy.s1_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s2_title') }}</h2>
                        <p>{{ __('home.privacy.s2_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s3_title') }}</h2>
                        <p>{{ __('home.privacy.s3_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s4_title') }}</h2>
                        <p>{{ __('home.privacy.s4_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s5_title') }}</h2>
                        <p>{{ __('home.privacy.s5_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s6_title') }}</h2>
                        <p>{{ __('home.privacy.s6_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s7_title') }}</h2>
                        <p>{{ __('home.privacy.s7_body') }}</p>
                    </div>

                    <div class="policy-block">
                        <h2>{{ __('home.privacy.s8_title') }}</h2>
                        <p>{{ __('home.privacy.s8_body') }}</p>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('root') }}" class="btn btn-primary px-5">
                            {{ __('home.privacy.back') }}
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>
</main>
@endsection
