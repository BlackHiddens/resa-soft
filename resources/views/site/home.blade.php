@extends('layouts.base')

@php
    $brandLogo  = asset('images/logo-28degres.jpg');
    $heroBanner = asset('images/gallery/ta-01.jpg');
    $waNumber   = preg_replace('/\D+/', '', (string) config('services.whatsapp.number'));
    $waDefault  = (string) config('services.whatsapp.default_message');
    $waLink     = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waDefault);
    $email      = (string) config('services.contact.email');
    $phone      = (string) config('services.contact.phone');
    $location   = (string) config('services.contact.location');
    $instaLink  = 'https://www.instagram.com/28degres_mylife/';
    $locale     = app()->getLocale();
@endphp

@section('title', __('home.page_title'))
@section('meta_description'){{ __('home.meta_desc') }}@endsection

@section('head-extra')
{{-- Force light mode (override du script dark-mode Bootstrap dans head-css) --}}
<script>document.documentElement.setAttribute('data-bs-theme','light');</script>

{{-- ── hreflang — toujours les deux, quel que soit le locale courant ── --}}
<link rel="alternate" hreflang="fr"       href="https://www.28degresmylife.com/">
<link rel="alternate" hreflang="en"       href="https://www.28degresmylife.com/en">
<link rel="alternate" hreflang="x-default" href="https://www.28degresmylife.com/">

{{-- ── Canonical ────────────────────────────────────────────────────── --}}
<link rel="canonical" href="{{ __('home.seo.canonical') }}">

{{-- ── Open Graph ─────────────────────────────────────────────────── --}}
<meta property="og:type"         content="website">
<meta property="og:url"          content="{{ __('home.seo.canonical') }}">
<meta property="og:title"        content="{{ __('home.seo.og_title') }}">
<meta property="og:description"  content="{{ __('home.seo.og_desc') }}">
<meta property="og:image"        content="https://www.28degresmylife.com/images/gallery/ta-01.jpg">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale"       content="{{ __('home.seo.og_locale') }}">
<meta property="og:site_name"    content="28 Degrés My Life">

{{-- ── Twitter / X Card ──────────────────────────────────────────── --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ __('home.seo.tw_title') }}">
<meta name="twitter:description" content="{{ __('home.seo.tw_desc') }}">
<meta name="twitter:image"       content="https://www.28degresmylife.com/images/gallery/ta-01.jpg">

{{-- ── Schema.org JSON-LD ────────────────────────────────────────── --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["LocalBusiness", "TouristAttraction"],
      "@id": "https://www.28degresmylife.com/#business",
      "name": "28 Degrés My Life",
      "description": {{ json_encode(__('home.seo.schema_desc')) }},
      "url": "https://www.28degresmylife.com/",
      "logo": "https://www.28degresmylife.com/images/logo-28degres.jpg",
      "image": [
        "https://www.28degresmylife.com/images/gallery/ta-01.jpg",
        "https://www.28degresmylife.com/images/caro-marco.jpg"
      ],
      "telephone": {{ json_encode($phone) }},
      "email": {{ json_encode($email) }},
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Martinique",
        "addressRegion": "Martinique",
        "addressCountry": "FR"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 14.6415,
        "longitude": -61.0242
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        "opens": "07:00",
        "closes": "20:00"
      },
      "priceRange": "€€",
      "currenciesAccepted": "EUR",
      "paymentAccepted": "Cash, Virement bancaire",
      "sameAs": [
        "https://www.instagram.com/28degres_mylife/",
        "https://www.tripadvisor.fr/Attraction_Review-g147354-d21373488-Reviews-28_Degres_My_Life-Martinique.html"
      ],
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "47",
        "reviewCount": "47"
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": {{ json_encode(__('home.seo.schema_catalog')) }},
        "itemListElement": [
          {
            "@type": "Offer",
            "name": {{ json_encode(__('home.seo.schema_offer1')) }},
            "description": {{ json_encode(__('home.seo.schema_offer1d')) }},
            "category": {{ json_encode($locale === 'en' ? 'Sea excursion' : 'Excursion maritime') }}
          },
          {
            "@type": "Offer",
            "name": {{ json_encode(__('home.seo.schema_offer2')) }},
            "description": {{ json_encode(__('home.seo.schema_offer2d')) }},
            "category": {{ json_encode($locale === 'en' ? 'Gastronomy' : 'Gastronomie') }}
          },
          {
            "@type": "Offer",
            "name": {{ json_encode(__('home.seo.schema_offer3')) }},
            "description": {{ json_encode(__('home.seo.schema_offer3d')) }},
            "category": {{ json_encode($locale === 'en' ? 'Privatisation' : 'Privatisation') }}
          },
          {
            "@type": "Offer",
            "name": {{ json_encode(__('home.seo.schema_offer4')) }},
            "description": {{ json_encode(__('home.seo.schema_offer4d')) }},
            "category": {{ json_encode($locale === 'en' ? 'Wellness' : 'Bien-être') }}
          }
        ]
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q1')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a1')) }} }
        },
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q2')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a2')) }} }
        },
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q3')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a3')) }} }
        },
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q4')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a4')) }} }
        },
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q5')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a5')) }} }
        },
        {
          "@type": "Question",
          "name": {{ json_encode(__('home.seo.faq_q6')) }},
          "acceptedAnswer": { "@type": "Answer", "text": {{ json_encode(__('home.seo.faq_a6')) }} }
        }
      ]
    }
  ]
}
</script>
@endsection

{{-- ── Navbar ───────────────────────────────────────────────────────── --}}
@section('header')
    <nav class="navbar navbar-28 navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('root') }}">
                <img src="{{ $brandLogo }}" alt="Logo 28 Degrés My Life" class="brand-logo">
                <span class="brand-name">28 Degrés My Life</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#nav28" aria-controls="nav28" aria-expanded="false"
                aria-label="{{ __('home.nav.aria_menu') }}">
                <span class="navbar-toggler-animation">
                    <span></span><span></span><span></span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="nav28">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="#services">{{ __('home.nav.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#couple">Caro &amp; Marco</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galerie">{{ __('home.nav.gallery') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#avis">{{ __('home.nav.reviews') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">{{ __('home.nav.faq') }}</a></li>
                    {{-- Sélecteur de langue --}}
                    <li class="nav-item ms-lg-1">
                        <a class="nav-link nav-lang-switch" href="{{ __('home.nav.lang_url') }}"
                            title="{{ __('home.nav.lang_title') }}">
                            {{ __('home.nav.lang_label') }}
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-primary btn-sm px-3" href="#contact">
                            {{ __('home.nav.reserve') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
<main>

    {{-- ══════════════════════════════════════════════════════════
         HERO — parallax Jarallax
    ══════════════════════════════════════════════════════════ --}}
    <section class="hero-28">
        <div class="hero-28__bg bg-parallax jarallax"
             data-jarallax data-speed="0.55"
             style="background-image:url('{{ $heroBanner }}');"></div>
        <div class="hero-28__overlay"></div>

        {{-- Bulles décoratives flottantes (aria-hidden) --}}
        <div class="hero-bubbles" aria-hidden="true">
            <span class="bubble bubble--1"></span>
            <span class="bubble bubble--2"></span>
            <span class="bubble bubble--3"></span>
            <span class="bubble bubble--4"></span>
            <span class="bubble bubble--5"></span>
            <span class="bubble bubble--6"></span>
            <span class="bubble bubble--7"></span>
        </div>

        <div class="hero-28__content w-100">
            <div class="container">
                <div class="row g-5 align-items-center">

                    {{-- Texte hero --}}
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                        <div class="hero-pill">
                            <i class="bi bi-geo-alt-fill"></i>
                            {!! __('home.hero.pill') !!}
                        </div>
                        <h1>
                            {{ __('home.hero.title_1') }}<br>
                            {{ __('home.hero.title_2') }}<br>
                            <span class="accent">Caro &amp; Marco</span>
                        </h1>
                        <p class="lead">
                            {{ __('home.hero.lead') }}
                        </p>
                        <div class="hero-cta-group d-flex flex-wrap gap-3 mb-4">
                            <a class="btn btn-whatsapp btn-lg" href="{{ $waLink }}"
                                target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp me-2"></i>{{ __('home.hero.cta_wa') }}
                            </a>
                            <a class="btn btn-outline-light btn-lg" href="#services">
                                {{ __('home.hero.cta_disc') }}
                            </a>
                        </div>
                        <div class="hero-badges">
                            <span class="hero-badge"><i class="bi bi-check-circle-fill"></i>{{ __('home.hero.badge_1') }}</span>
                            <span class="hero-badge"><i class="bi bi-check-circle-fill"></i>{{ __('home.hero.badge_2') }}</span>
                            <span class="hero-badge"><i class="bi bi-check-circle-fill"></i>{{ __('home.hero.badge_3') }}</span>
                            <span class="hero-badge"><i class="bi bi-check-circle-fill"></i>{{ __('home.hero.badge_4') }}</span>
                        </div>
                    </div>

                    {{-- Carte quick contact --}}
                    <div class="col-lg-5 offset-lg-1" data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                        <div class="hero-card">
                            <div class="hero-card__header">
                                <h5><i class="fab fa-whatsapp me-2"></i>{{ __('home.card.title') }}</h5>
                                <p>{{ __('home.card.subtitle') }}</p>
                            </div>
                            <div class="hero-card__body">
                                <form id="waQuickForm" class="row g-3">
                                    <div class="col-12">
                                        <label for="waName" class="form-label">{{ __('home.card.name_lbl') }}</label>
                                        <input id="waName" type="text" class="form-control"
                                            placeholder="{{ __('home.card.name_ph') }}" autocomplete="given-name">
                                    </div>
                                    <div class="col-12">
                                        <label for="waService" class="form-label">{{ __('home.card.svc_lbl') }}</label>
                                        <select id="waService" class="form-select">
                                            <option value="{{ __('home.card.svc_sea') }}">{{ __('home.card.svc_sea') }}</option>
                                            <option value="{{ __('home.card.svc_brunch') }}">{{ __('home.card.svc_brunch') }}</option>
                                            <option value="{{ __('home.card.svc_sunset') }}">{{ __('home.card.svc_sunset') }}</option>
                                            <option value="{{ __('home.card.svc_dinner') }}">{{ __('home.card.svc_dinner') }}</option>
                                            <option value="{{ __('home.card.svc_island') }}">{{ __('home.card.svc_island') }}</option>
                                            <option value="{{ __('home.card.svc_cooking') }}">{{ __('home.card.svc_cooking') }}</option>
                                            <option value="{{ __('home.card.svc_massage') }}">{{ __('home.card.svc_massage') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="waDate" class="form-label">{{ __('home.card.date_lbl') }}</label>
                                        <input id="waDate" type="text" class="form-control"
                                            placeholder="{{ __('home.card.date_ph') }}">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-whatsapp w-100 py-2" type="submit">
                                            <i class="fab fa-whatsapp me-2"></i>{{ __('home.card.submit') }}
                                        </button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="small text-muted">{{ __('home.card.email_or') }} </span>
                                        <a href="mailto:{{ $email }}" class="small text-primary">{{ $email }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Vague bas de hero --}}
        <div class="hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none">
                <path fill="#ffffff" d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         SOCIAL PROOF STRIP
    ══════════════════════════════════════════════════════════ --}}
    <div class="proof-strip">
        <div class="container">
            <div class="proof-strip__inner">
                <span class="proof-item">
                    <span class="stars">★★★★★</span>
                    <span>{{ __('home.proof.reviews') }}</span>
                </span>
                <span class="proof-item">
                    <i class="bi bi-shield-check"></i> {{ __('home.proof.private') }}
                </span>
                <span class="proof-item">
                    <i class="fab fa-whatsapp"></i> {{ __('home.proof.response') }}
                </span>
                <span class="proof-item">
                    <i class="bi bi-award"></i> {{ __('home.proof.local') }}
                </span>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         STATS / KPIs — PureCounter
    ══════════════════════════════════════════════════════════ --}}
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="kpi-card">
                        <div class="kpi-card__icon"><i class="bi bi-people-fill"></i></div>
                        <span class="kpi-number">
                            <span data-purecounter-start="0" data-purecounter-end="200"
                                  data-purecounter-duration="2" class="purecounter">200</span>
                            <span class="kpi-suffix">+</span>
                        </span>
                        <p class="kpi-label">{{ __('home.stats.guests_lbl') }}</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                    <div class="kpi-card">
                        <div class="kpi-card__icon"><i class="bi bi-grid-fill"></i></div>
                        <span class="kpi-number">
                            <span data-purecounter-start="0" data-purecounter-end="6"
                                  data-purecounter-duration="1" class="purecounter">6</span>
                        </span>
                        <p class="kpi-label">{{ __('home.stats.exp_lbl') }}</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                    <div class="kpi-card">
                        <div class="kpi-card__icon"><i class="bi bi-star-fill"></i></div>
                        <span class="kpi-number">5<span class="kpi-suffix fs-4">/5</span></span>
                        <p class="kpi-label">{{ __('home.stats.rating_lbl') }}</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                    <div class="kpi-card">
                        <div class="kpi-card__icon"><i class="bi bi-chat-heart-fill"></i></div>
                        <span class="kpi-number">7<span class="kpi-suffix fs-4">/7</span></span>
                        <p class="kpi-label">{{ __('home.stats.wa_lbl') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         SERVICES
    ══════════════════════════════════════════════════════════ --}}
    <section id="services" class="services-section bg-sand">

        {{-- Vague entrée --}}
        <div class="wave-divider" style="margin-top:-2px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 50" preserveAspectRatio="none">
                <path fill="#f8f2e9" d="M0,20 C480,50 960,0 1440,20 L1440,0 L0,0 Z"/>
            </svg>
        </div>

        <div class="container py-2">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-lg-7">
                    <span class="section-kicker">{{ __('home.services.kicker') }}</span>
                    <h2 class="section-title">
                        {!! __('home.services.title') !!}
                    </h2>
                    <p class="text-muted mt-3 mb-0">
                        {{ __('home.services.lead') }}
                    </p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                {{-- Service 1 — Excursion en mer --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="0">
                    <article class="service-card">
                        <img src="/images/28dml/snorkeling-excursion-28dml.jpg" class="service-card__img"
                            alt="{{ __('home.services.sea_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-water"></i></div>
                            <h5>{{ __('home.services.sea_title') }}</h5>
                            <p>{{ __('home.services.sea_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 2 — Brunch en mer --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="80">
                    <article class="service-card">
                        <img src="/images/28dml/tapas-verrines-28dml.jpg" class="service-card__img"
                            alt="{{ __('home.services.brunch_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-egg-fried"></i></div>
                            <h5>{{ __('home.services.brunch_title') }}</h5>
                            <p>{{ __('home.services.brunch_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 3 — Coucher de soleil en mer --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="160">
                    <article class="service-card">
                        <img src="/images/gallery/ta-01.jpg" class="service-card__img"
                            alt="{{ __('home.services.sunset_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-sunset-fill"></i></div>
                            <h5>{{ __('home.services.sunset_title') }}</h5>
                            <p>{{ __('home.services.sunset_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 4 — Dîner romantique --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="0">
                    <article class="service-card">
                        <img src="/images/28dml/diner-romantique-ilet-28dml.webp" class="service-card__img"
                            alt="{{ __('home.services.dinner_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-moon-stars-fill"></i></div>
                            <h5>{{ __('home.services.dinner_title') }}</h5>
                            <p>{{ __('home.services.dinner_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 5 — Journée sur l'îlet --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="80">
                    <article class="service-card">
                        <img src="/images/28dml/ilet-palmier-28dml.jpg" class="service-card__img"
                            alt="{{ __('home.services.island_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-brightness-high-fill"></i></div>
                            <h5>{{ __('home.services.island_title') }}</h5>
                            <p>{{ __('home.services.island_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 6 — Cours de cuisine --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="160">
                    <article class="service-card">
                        <img src="/images/28dml/plat-creole-28dml.jpg" class="service-card__img"
                            alt="{{ __('home.services.cooking_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-fire"></i></div>
                            <h5>{{ __('home.services.cooking_title') }}</h5>
                            <p>{{ __('home.services.cooking_desc') }}</p>
                        </div>
                    </article>
                </div>
                {{-- Service 7 — Massage bien-être --}}
                <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="0">
                    <article class="service-card">
                        <img src="/images/about/05.jpg" class="service-card__img"
                            alt="{{ __('home.services.mass_title') }}">
                        <div class="service-card__body">
                            <div class="service-card__icon"><i class="bi bi-heart-pulse-fill"></i></div>
                            <h5>{{ __('home.services.mass_title') }}</h5>
                            <p>{{ __('home.services.mass_desc') }}</p>
                        </div>
                    </article>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a class="btn btn-primary btn-lg px-5" href="#contact">
                    {{ __('home.services.cta') }}
                </a>
                <p class="mt-3 mb-0 small text-muted">
                    <span class="wa-preferred-badge">
                        <i class="fab fa-whatsapp"></i>{{ __('home.services.wa_hint') }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Vague bas --}}
        <div class="wave-divider mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 50" preserveAspectRatio="none">
                <path fill="#ffffff" d="M0,30 C480,0 960,50 1440,30 L1440,50 L0,50 Z"/>
            </svg>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         CARO & MARCO
    ══════════════════════════════════════════════════════════ --}}
    <section id="couple" class="couple-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                {{-- Mosaïque photos --}}
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                    <div class="couple-mosaic">
                        <img src="/images/caro-marco.jpg" alt="Caro et Marco — le couple derrière 28 Degrés My Life"
                            class="couple-mosaic__main" style="object-position: center 30%">
                        <img src="/images/marco-skipper.jpg" alt="Marco — skipper et pêcheur passionné en Martinique"
                            class="couple-mosaic__side" style="object-position: center 25%">
                        <img src="/images/caro-marco-martinique.jpg" alt="Caro et Marco en mer, Martinique"
                            class="couple-mosaic__side" style="object-position: center 45%">
                    </div>
                </div>

                {{-- Texte --}}
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="150" data-aos-duration="800">
                    <span class="section-kicker">{{ __('home.couple.kicker') }}</span>
                    <h2 class="section-title mb-4">Caro &amp; Marco</h2>
                    <p class="text-muted mb-4">
                        {{ __('home.couple.intro') }}
                    </p>

                    <div class="couple-feature">
                        <div class="couple-feature__icon"><i class="bi bi-compass-fill"></i></div>
                        <div class="couple-feature__text">
                            <h6>{!! __('home.couple.marco_title') !!}</h6>
                            <p>{{ __('home.couple.marco_desc') }}</p>
                        </div>
                    </div>

                    <div class="couple-feature">
                        <div class="couple-feature__icon"><i class="bi bi-heart-fill"></i></div>
                        <div class="couple-feature__text">
                            <h6>{!! __('home.couple.caro_title') !!}</h6>
                            <p>{{ __('home.couple.caro_desc') }}</p>
                        </div>
                    </div>

                    <div class="couple-feature">
                        <div class="couple-feature__icon"><i class="bi bi-patch-check-fill"></i></div>
                        <div class="couple-feature__text">
                            <h6>{{ __('home.couple.promise_title') }}</h6>
                            <p>{{ __('home.couple.promise_desc') }}</p>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a class="btn btn-primary btn-lg" href="#contact">
                            {{ __('home.couple.cta_book') }}
                        </a>
                        <a class="btn btn-outline-secondary btn-lg" href="{{ $instaLink }}"
                            target="_blank" rel="noopener">
                            <i class="fab fa-instagram me-2"></i>{{ __('home.couple.cta_insta') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         HOW IT WORKS
    ══════════════════════════════════════════════════════════ --}}
    <section class="how-section bg-sea">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-lg-7">
                    <span class="section-kicker section-kicker--light">{{ __('home.how.kicker') }}</span>
                    <h2 class="section-title text-white mb-0">
                        {!! __('home.how.title') !!}
                    </h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4 position-relative" data-aos="fade-up" data-aos-delay="0">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <h5>{{ __('home.how.s1_title') }}</h5>
                        <p>{{ __('home.how.s1_desc') }}</p>
                    </div>
                    <div class="step-connector d-none d-md-block"></div>
                </div>
                <div class="col-md-4 position-relative" data-aos="fade-up" data-aos-delay="120">
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <h5>{{ __('home.how.s2_title') }}</h5>
                        <p>{{ __('home.how.s2_desc') }}</p>
                    </div>
                    <div class="step-connector d-none d-md-block"></div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="240">
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <h5>{{ __('home.how.s3_title') }}</h5>
                        <p>{{ __('home.how.s3_desc') }}</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a class="btn btn-light btn-lg px-5" href="#contact">
                    {{ __('home.how.cta') }}
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         GALERIE — GLightbox
    ══════════════════════════════════════════════════════════ --}}
    <section id="galerie" class="gallery-section">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-lg-7">
                    <span class="section-kicker">{{ __('home.gallery.kicker') }}</span>
                    <h2 class="section-title">{{ __('home.gallery.title') }}</h2>
                    <p class="text-muted mt-2 mb-0">
                        {{ __('home.gallery.lead') }}
                    </p>
                </div>
            </div>

            <div class="gallery-grid" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-grid__item gallery-grid__item--wide">
                    <a href="/images/gallery/ta-15.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_15') }}">
                        <img src="/images/gallery/ta-15.jpg" alt="Bateau Bora Bora sous un halo solaire, Martinique" style="object-position:center 30%">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item gallery-grid__item--tall">
                    <a href="/images/gallery/ta-05.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_05') }}">
                        <img src="/images/gallery/ta-05.jpg" alt="Le bateau Bora Bora de Marco dans la marina">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/gallery/ta-04.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_04') }}">
                        <img src="/images/gallery/ta-04.jpg" alt="Îlot secret eau turquoise Martinique">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/gallery/ta-08.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_08') }}">
                        <img src="/images/gallery/ta-08.jpg" alt="Détente totale sur l'îlot avec le Bora Bora">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/gallery/ta-09.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_09') }}">
                        <img src="/images/gallery/ta-09.jpg" alt="Poisson frais grillé par Caro">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item gallery-grid__item--wide">
                    <a href="/images/gallery/ta-03.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_03') }}">
                        <img src="/images/gallery/ta-03.jpg" alt="Repas les pieds dans l'eau, mer turquoise Martinique">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/gallery/ta-11.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_11') }}">
                        <img src="/images/gallery/ta-11.jpg" alt="Marco et le festin de tapas maison sur l'îlot">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/gallery/ta-13.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="{{ __('home.gallery.desc_13') }}">
                        <img src="/images/gallery/ta-13.jpg" alt="Famille et amis à table sur l'îlot privatisé">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/28dml/snorkeling-excursion-28dml.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="Snorkeling en eau cristalline — excursion en mer avec Marco">
                        <img src="/images/28dml/snorkeling-excursion-28dml.jpg" alt="Snorkeling eau turquoise Martinique">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item gallery-grid__item--wide">
                    <a href="/images/28dml/repas-ilet-28dml.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="Repas sur l'îlet — pieds dans l'eau, soleil et bonne humeur avec Marco">
                        <img src="/images/28dml/repas-ilet-28dml.jpg" alt="Repas avec Marco sur l'îlet privatisé, Martinique">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/28dml/mangrove-martinique-28dml.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="La mangrove martiniquaise — paysage unique lors de nos excursions">
                        <img src="/images/28dml/mangrove-martinique-28dml.jpg" alt="Mangrove eau transparente Martinique">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
                <div class="gallery-grid__item">
                    <a href="/images/28dml/carpaccio-thon-28dml.jpg"
                        data-glightbox data-gallery="sorties"
                        data-description="Carpaccio de thon avocat citron vert — création de Caro">
                        <img src="/images/28dml/carpaccio-thon-28dml.jpg" alt="Carpaccio thon avocat préparé par Caro">
                        <div class="gallery-grid__overlay"><i class="bi bi-zoom-in"></i></div>
                    </a>
                </div>
            </div>

            <div class="text-center mt-4" data-aos="fade-up">
                <a class="btn btn-outline-secondary" href="{{ $instaLink }}"
                    target="_blank" rel="noopener">
                    <i class="fab fa-instagram me-2"></i>{{ __('home.gallery.insta_cta') }}
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         AVIS — Splide slider
    ══════════════════════════════════════════════════════════ --}}
    <section id="avis" class="reviews-section">
        <div class="container">
            <div class="row mb-5 align-items-end" data-aos="fade-up">
                <div class="col-lg-6">
                    <span class="section-kicker">{{ __('home.reviews.kicker') }}</span>
                    <h2 class="section-title mb-0">{{ __('home.reviews.title') }}</h2>
                </div>
                <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
                    <a class="btn btn-outline-secondary btn-sm"
                        href="{{ $googleReviewUrl }}"
                        target="_blank" rel="noopener noreferrer">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 48 48" aria-hidden="true">
                            <path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9 3.2l6.7-6.7C35.8 2.5 30.2 0 24 0 14.6 0 6.6 5.4 2.6 13.3l7.8 6C12.4 13 17.8 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.8 7.2l7.5 5.8c4.4-4.1 7.1-10.1 7.1-17z"/>
                            <path fill="#FBBC05" d="M10.4 28.7c-.7-2-1-4.1-1-6.2s.4-4.3 1-6.2l-7.8-6C.9 13.5 0 18.6 0 24s.9 10.5 2.6 13.7l7.8-6z"/>
                            <path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.5-5.8c-2 1.4-4.6 2.2-7.7 2.2-6.2 0-11.5-4.2-13.4-9.8l-7.8 6C6.6 42.6 14.6 48 24 48z"/>
                        </svg>{{ __('home.reviews.share_cta') }}
                    </a>
                </div>
            </div>

            <div class="splide-reviews splide" aria-label="{{ __('home.reviews.title') }}">
                <div class="splide__track pb-4">
                    <ul class="splide__list">
                        @foreach($reviews as $review)
                        <li class="splide__slide px-2">
                            <div class="review-card">
                                <div class="review-card__stars">
                                    @for($i = 0; $i < ($review['rating'] ?? 5); $i++)★@endfor
                                </div>
                                <p class="review-card__quote">{{ $review['quote'] }}</p>
                                <div class="review-card__author">
                                    <div class="review-card__avatar">{{ $review['avatar'] }}</div>
                                    <div>
                                        <h6>{{ $review['author'] }}</h6>
                                        <small>{{ $review['meta'] }}</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         INSTAGRAM CTA
    ══════════════════════════════════════════════════════════ --}}
    <div class="insta-section">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-lg-8" data-aos="fade-right">
                    <h4 class="text-white mb-1 fw-bold">
                        <i class="fab fa-instagram me-2"></i>{{ __('home.insta.title') }}
                    </h4>
                    <p class="text-white-50 mb-0">
                        {{ __('home.insta.subtitle') }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <a class="btn btn-outline-light btn-lg" href="{{ $instaLink }}"
                        target="_blank" rel="noopener">
                        <i class="fab fa-instagram me-2"></i>{{ __('home.insta.cta') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         FAQ
    ══════════════════════════════════════════════════════════ --}}
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4" data-aos="fade-right">
                    <span class="section-kicker">{{ __('home.faq.kicker') }}</span>
                    <h2 class="section-title mb-3">{{ __('home.faq.title') }}</h2>
                    <p class="text-muted">
                        {{ __('home.faq.contact_txt') }}
                    </p>
                    <a class="btn btn-primary mt-2" href="#contact">
                        {{ __('home.faq.contact_cta') }}
                    </a>
                    <p class="mt-3 mb-0">
                        <span class="wa-preferred-badge">
                            <i class="fab fa-whatsapp"></i>{{ __('home.faq.wa_hint') }}
                        </span>
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1" data-aos="fade-left" data-aos-delay="100">
                    <div class="accordion accordion-icon accordion-border-bottom" id="faq28">

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
                                    {{ __('home.faq.q1') }}
                                </button>
                            </h6>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a1') }}</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                                    {{ __('home.faq.q2') }}
                                </button>
                            </h6>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a2') }}</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                                    {{ __('home.faq.q3') }}
                                </button>
                            </h6>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a3') }}</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                                    {{ __('home.faq.q4') }}
                                </button>
                            </h6>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a4') }}</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                                    {{ __('home.faq.q5') }}
                                </button>
                            </h6>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a5') }}</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false">
                                    {{ __('home.faq.q6') }}
                                </button>
                            </h6>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faq28">
                                <div class="accordion-body">{{ __('home.faq.a6') }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         CONTACT CTA
    ══════════════════════════════════════════════════════════ --}}
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row g-5 align-items-start">

                {{-- Gauche — CTA + infos --}}
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="section-kicker section-kicker--light">{{ __('home.contact.kicker') }}</span>
                    <h2 class="section-title text-white mb-3">
                        {{ __('home.contact.title') }}
                    </h2>
                    <p class="text-white-75 mb-4">
                        {{ __('home.contact.lead') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a class="btn btn-whatsapp btn-lg" href="{{ $waLink }}"
                            target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp me-2"></i>{{ __('home.contact.btn_wa') }}
                        </a>
                        <a class="btn btn-outline-light btn-lg" href="mailto:{{ $email }}">
                            <i class="bi bi-envelope me-2"></i>{{ __('home.contact.btn_email') }}
                        </a>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-info-item">
                            <i class="bi bi-geo-alt-fill"></i> {{ $location }}
                        </div>
                        <div class="contact-info-item">
                            <i class="bi bi-telephone-fill"></i> {{ $phone }}
                        </div>
                        <div class="contact-info-item">
                            <i class="bi bi-envelope-fill"></i> {{ $email }}
                        </div>
                        <div class="contact-info-item">
                            <i class="fab fa-whatsapp"></i> {!! __('home.contact.wa_priority') !!}
                        </div>
                        <div class="contact-info-item">
                            <i class="fab fa-instagram"></i>
                            <a href="{{ $instaLink }}" target="_blank" rel="noopener"
                                class="text-white-75 text-decoration-none">@28degres_mylife</a>
                        </div>
                    </div>
                </div>

                {{-- Droite — Formulaire email --}}
                <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-delay="150">
                    <div class="contact-form-wrap">
                        <h5>{{ __('home.contact.form_title') }}</h5>
                        <p>{{ __('home.contact.form_lead') }}</p>

                        @if(session('contact_success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('contact_success') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ __('home.contact.err_fields') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.email') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label" for="name">{{ __('home.contact.name_lbl') }}</label>
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email_f">{{ __('home.contact.email_lbl') }}</label>
                                <input id="email_f" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone_f">{{ __('home.contact.phone_lbl') }}</label>
                                <input id="phone_f" name="phone" type="tel"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="service_f">{{ __('home.contact.svc_lbl') }}</label>
                                <select id="service_f" name="service"
                                    class="form-select @error('service') is-invalid @enderror" required>
                                    <option value="">{{ __('home.contact.svc_choose') }}</option>
                                    <option value="Excursion en mer"      @selected(old('service')==='Excursion en mer')>{{ __('home.contact.svc_sea') }}</option>
                                    <option value="Brunch en mer"         @selected(old('service')==='Brunch en mer')>{{ __('home.contact.svc_brunch') }}</option>
                                    <option value="Coucher de soleil"     @selected(old('service')==='Coucher de soleil')>{{ __('home.contact.svc_sunset') }}</option>
                                    <option value="Dîner romantique"      @selected(old('service')==="Dîner romantique")>{{ __('home.contact.svc_dinner') }}</option>
                                    <option value="Journée sur l'îlet"    @selected(old('service')==="Journée sur l'îlet")>{{ __('home.contact.svc_island') }}</option>
                                    <option value="Cours de cuisine"      @selected(old('service')==='Cours de cuisine')>{{ __('home.contact.svc_cooking') }}</option>
                                    <option value="Massage bien-être"     @selected(old('service')==='Massage bien-être')>{{ __('home.contact.svc_massage') }}</option>
                                    <option value="Autre demande"      @selected(old('service')==='Autre demande')>{{ __('home.contact.svc_other') }}</option>
                                </select>
                                @error('service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message_f">{{ __('home.contact.msg_lbl') }}</label>
                                <textarea id="message_f" name="message" rows="4"
                                    class="form-control @error('message') is-invalid @enderror"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('home.contact.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

{{-- ══════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <img src="{{ $brandLogo }}" alt="Logo 28 Degrés My Life" class="site-footer-logo">
                <h6 class="footer-brand-name">28 Degrés My Life</h6>
                <p class="footer-tagline">
                    {!! __('home.footer.tagline') !!}
                </p>
                <div class="footer-social mt-3 d-flex gap-2">
                    <a href="{{ $instaLink }}" target="_blank" rel="noopener"
                        aria-label="Instagram 28 Degrés My Life">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ $waLink }}" target="_blank" rel="noopener"
                        aria-label="WhatsApp 28 Degrés My Life">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:{{ $email }}" aria-label="Email">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>
            <div class="col-6 col-lg-2 offset-lg-2">
                <h6 class="text-white fw-700 mb-3" style="font-weight:700;">{{ __('home.footer.nav_title') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#services" class="text-white-50 text-decoration-none small">{{ __('home.nav.services') }}</a></li>
                    <li><a href="#couple"   class="text-white-50 text-decoration-none small">Caro &amp; Marco</a></li>
                    <li><a href="#galerie"  class="text-white-50 text-decoration-none small">{{ __('home.nav.gallery') }}</a></li>
                    <li><a href="#avis"     class="text-white-50 text-decoration-none small">{{ __('home.nav.reviews') }}</a></li>
                    <li><a href="#faq"      class="text-white-50 text-decoration-none small">FAQ</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-4">
                <h6 class="text-white mb-3" style="font-weight:700;">{{ __('home.footer.cnt_title') }}</h6>
                <ul class="list-unstyled">
                    <li class="small text-white-50 mb-2">
                        <i class="bi bi-geo-alt me-1 text-gold"></i>{{ $location }}
                    </li>
                    <li class="small text-white-50 mb-2">
                        <i class="bi bi-telephone me-1 text-gold"></i>{{ $phone }}
                    </li>
                    <li class="small text-white-50 mb-2">
                        <i class="bi bi-envelope me-1 text-gold"></i>{{ $email }}
                    </li>
                </ul>
                <span class="wa-preferred-badge mt-2 d-inline-flex">
                    <i class="fab fa-whatsapp"></i>{{ __('home.footer.wa_hint') }}
                </span>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <p class="footer-copy">© {{ date('Y') }} 28 Degrés My Life — {{ __('home.footer.rights') }}</p>
            <div class="d-flex gap-3 align-items-center">
                <a href="{{ $locale === 'en' ? route('privacy.en') : route('privacy.fr') }}"
                   class="footer-link">{{ __('home.footer.privacy_link') }}</a>
            </div>
            <p class="footer-copy">{{ __('home.footer.made_with') }}</p>
        </div>
    </div>
</footer>

{{-- ══════════════════════════════════════════════════════════
     FLOATING WHATSAPP
══════════════════════════════════════════════════════════ --}}
<div class="wa-float">
    <button class="wa-float__toggle" id="waFloatToggle"
        aria-label="{{ __('home.wa_widget.aria_toggle') }}" aria-expanded="false">
        <i class="fab fa-whatsapp"></i>
    </button>
    <span class="wa-float__pulse" aria-hidden="true"></span>
    <div class="wa-float__panel" id="waFloatPanel" aria-hidden="true">
        <div class="wa-float__panel-head">
            <h6>{{ __('home.wa_widget.panel_title') }}</h6>
            <p>{{ __('home.wa_widget.panel_sub') }}</p>
        </div>
        <textarea id="waFloatMsg" class="form-control mb-2" rows="3"
            placeholder="{{ __('home.wa_widget.placeholder') }}"></textarea>
        <button class="btn btn-whatsapp w-100 mb-2" id="waFloatSend" type="button">
            <i class="fab fa-whatsapp me-2"></i>{{ __('home.wa_widget.send_btn') }}
        </button>
        <div class="text-center">
            <a href="mailto:{{ $email }}" class="small text-muted">{{ __('home.wa_widget.email_pref') }}</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    'use strict';

    const WA_BASE = 'https://wa.me/{{ $waNumber }}?text=';
    const WA_DEFAULT = @json($waDefault);

    // Strings localisées pour le formulaire WA
    const JS_DEFAULT_NAME    = @json(__('home.js.wa_default_name'));
    const JS_DEFAULT_SERVICE = @json(__('home.js.wa_default_service'));
    const JS_DEFAULT_DATE    = @json(__('home.js.wa_default_date'));
    const JS_MSG_P1          = @json(__('home.js.wa_msg_p1'));
    const JS_MSG_P2          = @json(__('home.js.wa_msg_p2'));
    const JS_MSG_P3          = @json(__('home.js.wa_msg_p3'));
    const JS_MSG_P4          = @json(__('home.js.wa_msg_p4'));

    /* ── Navbar scroll effect ── */
    const nav = document.getElementById('mainNav');
    if (nav) {
        const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 60);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ── Hero quick form ── */
    const quickForm = document.getElementById('waQuickForm');
    if (quickForm) {
        quickForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name    = document.getElementById('waName')?.value.trim()    || JS_DEFAULT_NAME;
            const service = document.getElementById('waService')?.value.trim() || JS_DEFAULT_SERVICE;
            const date    = document.getElementById('waDate')?.value.trim()    || JS_DEFAULT_DATE;
            const msg     = JS_MSG_P1 + name + JS_MSG_P2 + service + JS_MSG_P3 + date + JS_MSG_P4;
            window.open(WA_BASE + encodeURIComponent(msg), '_blank', 'noopener');
        });
    }

    /* ── Floating WhatsApp ── */
    const toggle  = document.getElementById('waFloatToggle');
    const panel   = document.getElementById('waFloatPanel');
    const sendBtn = document.getElementById('waFloatSend');
    const msgArea = document.getElementById('waFloatMsg');

    if (toggle && panel) {
        toggle.addEventListener('click', () => {
            const isOpen = panel.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen);
            panel.setAttribute('aria-hidden', (!isOpen).toString());
        });
        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !panel.contains(e.target)) {
                panel.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
            }
        });
    }

    if (sendBtn && msgArea) {
        sendBtn.addEventListener('click', () => {
            const text = msgArea.value.trim() || WA_DEFAULT;
            window.open(WA_BASE + encodeURIComponent(text), '_blank', 'noopener');
        });
    }

})();
</script>
@endsection
