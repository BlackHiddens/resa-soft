# Documentation Technique — 28 Degrés My Life

> Site vitrine bilingue (FR / EN) pour Caro & Marco — excursions en mer, tapas et massages en Martinique.
> Stack : **Laravel 12 · PHP 8.5 · Bootstrap 5.3 · Vite · SCSS**

---

## Table des matières

1. [Vue d'ensemble](#1-vue-densemble)
2. [Installation locale](#2-installation-locale)
3. [Variables d'environnement](#3-variables-denvironnement)
4. [Architecture des fichiers](#4-architecture-des-fichiers)
5. [Design System (couleurs, SCSS)](#5-design-system)
6. [Système multilingue (FR / EN)](#6-système-multilingue)
7. [Modifier le contenu](#7-modifier-le-contenu)
8. [Images & médias](#8-images--médias)
9. [SEO en place](#9-seo-en-place)
10. [Commandes de maintenance](#10-commandes-de-maintenance)
11. [Déploiement en production](#11-déploiement-en-production)
12. [Pièges connus & décisions techniques](#12-pièges-connus--décisions-techniques)

---

## 1. Vue d'ensemble

| Élément | Valeur |
|---|---|
| Framework | Laravel 12 |
| PHP requis | ≥ 8.2 |
| Thème de base | Bookinga v1.1.0 (thème commercial) |
| CSS Framework | Bootstrap 5.3 |
| Build tool | Vite 7 |
| CSS préprocesseur | SCSS (Sass) |
| Langues | Français (défaut) + Anglais |
| Pages actives | 1 seule : `/` (FR) et `/en` (EN) |

Le site est une **single-page marketing** — toutes les sections (héro, services, couple, galerie, avis, FAQ, contact) sont dans un seul template Blade.

Les pages du thème Bookinga (hôtel, vol, cab, admin…) sont présentes dans le dépôt mais **non utilisées** — ne pas les supprimer, elles ne nuisent pas.

---

## 2. Installation locale

```bash
# 1. Cloner / copier le projet
cd D:\Projects\28degresmylife\Bookinga-Laravel_v1.1.0\Booking

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JS
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Compiler les assets (mode dev avec hot-reload)
npm run dev

# OU build de production
npm run build

# 7. Lancer le serveur de développement
php artisan serve
# → http://localhost:8000
```

> **Important :** `npm run dev` ET `php artisan serve` doivent tourner simultanément en développement.  
> En production, seul le build (`npm run build`) est nécessaire, pas le serveur Vite.

---

## 3. Variables d'environnement

Fichier : `.env` à la racine (copié depuis `.env.example`)

### Variables critiques à configurer

```ini
APP_NAME="28 Degres My Life"
APP_ENV=production          # local | production
APP_DEBUG=false             # true uniquement en dev
APP_URL=https://www.28degresmylife.com

APP_LOCALE=fr               # langue par défaut
APP_FALLBACK_LOCALE=fr

# ── Mail (formulaire de contact) ──────────────────────────
MAIL_MAILER=smtp
MAIL_HOST=smtp.votrefournisseur.com
MAIL_PORT=587
MAIL_USERNAME=votre@email.com
MAIL_PASSWORD=motdepasse
MAIL_FROM_ADDRESS=contact@28degresmylife.com
MAIL_FROM_NAME="28 Degrés My Life"

# ── Coordonnées (injectées dans les templates) ─────────────
WHATSAPP_NUMBER=596696000000
WHATSAPP_DEFAULT_MESSAGE="Bonjour Caro et Marco, je souhaite réserver une excursion."
CONTACT_EMAIL=contact@28degresmylife.com
CONTACT_PHONE="+596 696 00 00 00"
CONTACT_LOCATION=Martinique
```

### Comment les variables de contact sont utilisées

Ces variables sont lues dans `home.blade.php` via :

```php
$waNumber = preg_replace('/\D+/', '', config('services.whatsapp.number'));
$email    = config('services.contact.email');
$phone    = config('services.contact.phone');
$location = config('services.contact.location');
```

Le fichier de configuration correspondant est `config/services.php`.

---

## 4. Architecture des fichiers

```
Booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── RoutingController.php   ← retourne la vue home
│   │   │   └── ContactController.php   ← traite le formulaire email
│   │   └── Middleware/
│   │       └── SetLocale.php           ← détecte /en → définit locale
│   └── ...
│
├── bootstrap/
│   └── app.php                         ← enregistrement du middleware SetLocale
│
├── config/
│   └── services.php                    ← WhatsApp, email, téléphone, localisation
│
├── lang/
│   ├── fr/
│   │   └── home.php                    ← toutes les chaînes FR (~200 clés)
│   └── en/
│       └── home.php                    ← toutes les chaînes EN (~200 clés)
│
├── public/
│   ├── images/
│   │   ├── logo-28degres.jpg           ← logo (aussi favicon)
│   │   ├── caro-marco.jpg              ← photo principale du couple
│   │   ├── marco-skipper.jpg           ← Marco avec poisson pêché
│   │   ├── caro-marco-martinique.jpg   ← selfie Caro & Marco
│   │   └── gallery/
│   │       ├── ta-01.jpg               ← photo héro (coucher de soleil)
│   │       ├── ta-03.jpg  …  ta-15.jpg ← photos TripAdvisor
│   └── build/                          ← assets compilés par Vite (ne pas éditer)
│
├── resources/
│   ├── js/
│   │   └── functions.js                ← point d'entrée JS Vite
│   ├── scss/
│   │   └── _user.scss                  ← TOUT le CSS custom 28DML (seul fichier à éditer)
│   └── views/
│       ├── layouts/
│       │   ├── base.blade.php          ← layout HTML racine
│       │   └── partials/
│       │       ├── head-css.blade.php  ← imports CSS + script dark-mode
│       │       ├── title-meta.blade.php ← <title>, meta charset, favicon, Google Fonts
│       │       └── footer-scripts.blade.php ← @vite JS + @yield('scripts')
│       └── site/
│           └── home.blade.php          ← PAGE PRINCIPALE (tout le contenu)
│
├── routes/
│   └── web.php                         ← routes / et /en
│
└── .env                                ← configuration locale (ne jamais commiter)
```

---

## 5. Design System

### Palette — 2 couleurs de marque uniquement

Toutes les couleurs sont des CSS Custom Properties définies au début de `resources/scss/_user.scss` :

```scss
:root {
  --c-teal:      #2D6B6A;   /* Couleur principale — tirée du logo */
  --c-teal-dark: #1C3F3E;   /* Fonds foncés, navbar, footer */
  --c-amber:     #F5A623;   /* Accent — étoiles, highlights, hover nav */
  --c-dark:      #12201F;   /* Quasi-noir */
  --c-text:      #3D5250;   /* Corps de texte */
  --c-white:     #FFFFFF;
}
```

> **Règle d'or :** utiliser exclusivement ces variables. Ne jamais écrire de valeur hexadécimale en dur dans les styles.

### Fichier SCSS unique

**`resources/scss/_user.scss`** est le seul fichier à modifier pour le CSS.  
Il est importé par le thème Bookinga via Vite.

**Structure interne de `_user.scss` :**
```
:root { variables }
UTILITAIRES
BOUTON WHATSAPP (.btn-whatsapp)
NAVBAR (.navbar-28)
  └── Sélecteur de langue (.nav-lang-switch)
HERO (.hero-28, .hero-pill, .hero-card, .hero-badges, .hero-wave)
PROOF STRIP (.proof-strip)
STATS (.stats-section, .kpi-card)
SERVICES (.services-section, .service-card)
COUPLE (.couple-section, .couple-mosaic, .couple-feature)
HOW IT WORKS (.how-section, .step-card)
GALLERY (.gallery-section, .gallery-grid)
REVIEWS (.reviews-section, .review-card)
INSTAGRAM CTA (.insta-section)
FAQ (.faq-section)
CONTACT (.contact-section, .contact-info-card, .contact-form-wrap)
FLOATING WHATSAPP (.wa-float)
FOOTER (.site-footer)
BOOTSTRAP OVERRIDES (accordion dark-mode fixes)
```

Après chaque modification SCSS, relancer :
```bash
npm run build    # production
# ou
npm run dev      # développement (hot-reload)
```

---

## 6. Système multilingue

### Fonctionnement

| URL | Langue | html lang |
|---|---|---|
| `https://www.28degresmylife.com/` | 🇫🇷 Français | `lang="fr"` |
| `https://www.28degresmylife.com/en` | 🇬🇧 English | `lang="en"` |

**Middleware `app/Http/Middleware/SetLocale.php`**  
Lit le premier segment de l'URL. Si c'est `en` → `app()->setLocale('en')`, sinon `fr`.

**Routes `routes/web.php`**
```php
Route::get('/', [RoutingController::class, 'root'])->name('root');
Route::get('/en', [RoutingController::class, 'root'])->name('root.en');
```

### Fichiers de traduction

```
lang/
├── fr/home.php   ← ~200 clés en français
└── en/home.php   ← ~200 clés en anglais
```

**Structure des clés (par section) :**
```
page_title, meta_desc
seo.*            ← og:title, og:desc, canonical, hreflang, Schema.org
nav.*            ← liens navbar, bouton langue
hero.*           ← pill, h1, lead, CTA, badges
card.*           ← formulaire express WhatsApp
proof.*          ← bandeau social proof
stats.*          ← KPIs
services.*       ← 6 cartes service
couple.*         ← section Caro & Marco
how.*            ← 3 étapes
gallery.*        ← descriptions lightbox
reviews.*        ← 6 avis TripAdvisor
insta.*          ← CTA Instagram
faq.*            ← 6 questions/réponses
contact.*        ← section contact + formulaire
footer.*
wa_widget.*      ← widget WhatsApp flottant
js.*             ← chaînes pour le JavaScript
```

### Utilisation dans les templates Blade

```blade
{{ __('home.hero.title_1') }}           ← texte normal (échappé)
{!! __('home.footer.tagline') !!}       ← texte avec HTML (& &amp; etc.)
{!! __('home.services.title') !!}       ← contient <br> → utiliser {!! !!}
```

### Ajouter une nouvelle traduction

1. Ajouter la clé dans `lang/fr/home.php`
2. Ajouter la traduction dans `lang/en/home.php`
3. Utiliser `{{ __('home.nouvelle_cle') }}` dans le template

### Ajouter une 3e langue (ex: Espagnol)

1. Créer `lang/es/home.php` (copier `lang/en/home.php` et traduire)
2. Dans `SetLocale.php`, ajouter `'es'` au tableau `SUPPORTED`
3. Ajouter la route `Route::get('/es', ...)->name('root.es')` dans `web.php`
4. Dans `home.blade.php`, mettre à jour le sélecteur de langue dans la navbar

### ⚠️ Piège JSON-LD & directive Blade `@context`

Laravel 12 a introduit une directive Blade `@context`. Dans les blocs JSON-LD, le `"@context": "https://schema.org"` doit être **doublé** pour être ignoré par Blade :

```blade
{{-- CORRECT --}}
"@@context": "https://schema.org",

{{-- INCORRECT — Blade compile @context comme une directive PHP → crash 500 --}}
"@context": "https://schema.org",
```

---

## 7. Modifier le contenu

### Textes (toutes les langues)

Éditer **uniquement** les fichiers de traduction :

- `lang/fr/home.php` — version française
- `lang/en/home.php` — version anglaise

Aucune modification du template Blade n'est nécessaire pour les textes.

### Ajouter/modifier un avis client

Dans `lang/fr/home.php` et `lang/en/home.php`, section `reviews` :

```php
'reviews' => [
    'r1_quote'  => "Texte de l'avis...",
    'r1_author' => 'Prénom N.',
    'r1_meta'   => 'Type de sortie · Mois Année · TripAdvisor ★ 5/5',
    // ...jusqu'à r6
],
```

Les avatars (2 lettres) dans la vue sont codés en dur dans le template (`home.blade.php`, section `splide__list`). Si tu ajoutes un 7e avis, ajouter aussi un `<li class="splide__slide">` dans le template.

### Ajouter une question FAQ

1. Dans les deux fichiers de traduction, section `faq`, ajouter `q7`/`a7`
2. Dans `home.blade.php`, dupliquer un bloc `<div class="accordion-item">` avec l'id `#faq7`
3. Dans `head-extra` du même fichier, ajouter l'entrée dans le `FAQPage` Schema.org

### Modifier les coordonnées

**Ne pas modifier les fichiers PHP** — uniquement le `.env` :

```ini
WHATSAPP_NUMBER=596696111111
CONTACT_EMAIL=nouveau@email.com
CONTACT_PHONE="+596 696 11 11 11"
CONTACT_LOCATION=Martinique, Antilles
```

---

## 8. Images & médias

### Localisation des fichiers

```
public/images/
├── logo-28degres.jpg          ← logo + favicon (carré ~200×200)
├── caro-marco.jpg             ← mosaïque couple (900×770 px)
├── marco-skipper.jpg          ← mosaïque side (900×675 px)
├── caro-marco-martinique.jpg  ← mosaïque side (800×825 px)
└── gallery/
    ├── ta-01.jpg              ← photo héro (utilisée aussi en OG image)
    ├── ta-03.jpg              ← galerie
    ├── ta-04.jpg
    ├── ta-05.jpg
    ├── ta-08.jpg
    ├── ta-09.jpg
    ├── ta-11.jpg
    ├── ta-13.jpg
    └── ta-15.jpg
```

### Remplacer une photo

1. Copier la nouvelle image dans `public/images/` (ou `public/images/gallery/`)
2. Nommer le fichier de façon descriptive + SEO (ex: `martinique-excursion-mer.jpg`)
3. Modifier la référence dans `home.blade.php` (chercher l'ancien nom de fichier)
4. Pour la **photo héro** (`ta-01.jpg`) : aussi mettre à jour l'URL dans `og:image` dans `lang/fr/home.php` et `lang/en/home.php` clé `seo.og_image` si tu l'ajoutes

### Bonne pratique pour les photos

| Usage | Dimensions recommandées | Format |
|---|---|---|
| Héro (fond parallax) | ≥ 1920×1080 | JPG optimisé |
| OG Image (partage social) | 1200×630 exactement | JPG |
| Galerie (lightbox) | ≥ 1200px de large | JPG |
| Mosaïque couple (principale) | ~900×700 | JPG |
| Mosaïque couple (côté) | ~900×700 | JPG |
| Logo | 200×200 (carré) | JPG ou PNG |

### `object-position` pour les photos mosaïque

Dans `home.blade.php`, les photos ont un `style="object-position: center XX%"` inline pour cadrer correctement dans la grille CSS `object-fit: cover`. Ajuster le pourcentage si une photo montre une mauvaise zone.

```html
<img src="/images/caro-marco.jpg"
     class="couple-mosaic__main"
     style="object-position: center 30%">
```

---

## 9. SEO en place

### Balises head (auto-générées)

| Balise | Valeur |
|---|---|
| `<title>` | `__('home.page_title')` |
| `<meta name="description">` | `__('home.meta_desc')` |
| `<link rel="canonical">` | `__('home.seo.canonical')` |
| `<link rel="alternate" hreflang="fr">` | `https://www.28degresmylife.com/` |
| `<link rel="alternate" hreflang="en">` | `https://www.28degresmylife.com/en` |
| `<link rel="alternate" hreflang="x-default">` | `https://www.28degresmylife.com/` |
| `og:type, og:url, og:title, og:description, og:image` | ✅ |
| `og:locale` | `fr_FR` ou `en_US` selon la langue |
| `twitter:card = summary_large_image` | ✅ |

### Schema.org JSON-LD (2 blocs)

1. **LocalBusiness + TouristAttraction** — nom, adresse, GPS Martinique, horaires, prix, sameAs Instagram/TripAdvisor, `aggregateRating` 5/5, catalogue des 4 offres
2. **FAQPage** — 6 questions/réponses (éligible aux rich snippets Google)

### Mettre à jour le Schema.org

Toutes les chaînes du JSON-LD sont dans les fichiers de traduction, section `seo.*`.

Pour mettre à jour le nombre d'avis TripAdvisor :

```php
// lang/fr/home.php ET lang/en/home.php — section seo
// Dans home.blade.php, chercher aggregateRating et ratingCount
"ratingCount": "47",  // ← changer ce nombre
"reviewCount": "47",
```

> Ces valeurs sont actuellement en dur dans `home.blade.php` (dans le bloc JSON-LD). Pour les rendre dynamiques, les déplacer dans les fichiers de traduction.

### Google Search Console

Après déploiement :
1. Vérifier le domaine dans [Search Console](https://search.google.com/search-console)
2. Soumettre le sitemap (à créer si besoin : `php artisan sitemap:generate` avec un package dédié)
3. Tester le JSON-LD avec l'[outil de test des résultats enrichis](https://search.google.com/test/rich-results)

---

## 10. Commandes de maintenance

### Quotidien / après modification de code

```bash
# Vider tous les caches Laravel
php artisan view:clear      # vues Blade compilées
php artisan cache:clear     # cache applicatif
php artisan route:clear     # cache des routes
php artisan config:clear    # cache de config

# Recompiler les vues (optionnel mais recommandé en prod)
php artisan view:cache

# Recompiler les assets CSS/JS
npm run build
```

### Vérifier les erreurs

```bash
# Dernières erreurs Laravel
tail -100 storage/logs/laravel.log

# Tester que toutes les vues Blade sont valides PHP
for f in storage/framework/views/*.php; do php -l "$f" 2>&1 | grep "Parse error"; done
```

### Mise à jour des dépendances

```bash
# PHP
composer update
composer install --no-dev --optimize-autoloader  # production

# JavaScript
npm update
npm install
npm run build
```

---

## 11. Déploiement en production

### Checklist avant mise en ligne

```ini
# .env production
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.28degresmylife.com
MAIL_MAILER=smtp   # configurer le vrai SMTP
```

### Commandes à lancer sur le serveur

```bash
# 1. Récupérer le code
git pull

# 2. Installer les dépendances PHP (sans dev)
composer install --no-dev --optimize-autoloader

# 3. Build des assets
npm install && npm run build

# 4. Caches Laravel optimisés
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Permissions fichiers
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 6. Migrations (si base de données utilisée)
php artisan migrate --force
```

### Configuration serveur web (Apache)

```apache
<VirtualHost *:443>
    ServerName www.28degresmylife.com
    DocumentRoot /var/www/28degresmylife/public

    <Directory /var/www/28degresmylife/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

> Le `DocumentRoot` doit pointer sur `/public`, **pas** sur la racine du projet.

---

## 12. Pièges connus & décisions techniques

### 1. Dark mode Bootstrap — forcé en light

`layouts/partials/head-css.blade.php` contient un script JS qui détecte la préférence système et applique `data-bs-theme="dark"` ou `"light"` sur `<html>`.

**Le site force toujours le mode clair** via une injection dans `@section('head-extra')` de `home.blade.php` :

```blade
<script>document.documentElement.setAttribute('data-bs-theme','light');</script>
```

Ce script s'exécute APRÈS le script du thème car il est dans `@yield('head-extra')` placé APRÈS `@include('layouts.partials/head-css')` dans `base.blade.php`.

### 2. `@@context` dans le JSON-LD

Voir [Section 6 — Piège JSON-LD](#%EF%B8%8F-piège-json-ld--directive-blade-context).

En résumé : dans un template Blade, tout `@motclé` est interprété comme une directive. Échapper avec `@@motclé` pour obtenir `@motclé` dans le HTML.

### 3. Bootstrap Icons — vérifier avant d'utiliser

Toutes les icônes Bootstrap Icons ne sont pas disponibles dans la version installée. Avant d'utiliser une icône, vérifier son existence :

```bash
grep "bi-nom-de-licone" public/build/assets/bootstrap-icons-*.css
```

### 4. `{{ }}` vs `{!! !!}` dans les traductions

- `{{ __('home.key') }}` — **échappe** le HTML (utiliser pour du texte pur)
- `{!! __('home.key') !!}` — **n'échappe pas** (utiliser si la traduction contient `<br>`, `&amp;`, `&lt;` etc.)

Exemples nécessitant `{!! !!}` :
- `home.services.title` (contient `<br>`)
- `home.footer.tagline` (contient `&amp;`)
- `home.contact.wa_priority` (contient `&lt;`)
- `home.couple.marco_title` (contient `&amp;`)

### 5. Directive `@json()` avec parenthèses imbriquées

`@json(__('home.js.wa_msg_p1'))` fonctionne en Laravel 12 (le parser Blade gère les parenthèses imbriquées). Alternative équivalente si problème : `{!! json_encode(__('home.js.wa_msg_p1')) !!}`.

### 6. `html lang` dynamique

`base.blade.php` utilise `lang="{{ app()->getLocale() }}"` — le middleware `SetLocale` doit s'exécuter avant le rendu de la vue pour que cette valeur soit correcte.

### 7. Middleware `SetLocale` dans la pipeline

Le middleware est enregistré dans `bootstrap/app.php` via :
```php
$middleware->web(append: [
    \App\Http\Middleware\SetLocale::class,
]);
```

Il est ajouté **après** les middlewares web natifs Laravel (session, CSRF, etc.). C'est correct — la locale doit être définie avant le rendu de la vue, pas avant le démarrage de la session.

### 8. Les pages du thème Bookinga (non utilisées)

Les vues dans `resources/views/hotel/`, `views/tour/`, `views/cab/`, etc. sont des templates du thème commercial et ne sont pas utilisées. La route catch-all `Route::get('{any}', ...)` dans `web.php` renvoie vers `home.blade.php` pour toute URL inconnue.

---

## Contacts & ressources

| Ressource | Lien |
|---|---|
| TripAdvisor 28DML | https://www.tripadvisor.fr/Attraction_Review-g147354-d21373488 |
| Instagram | https://www.instagram.com/28degres_mylife/ |
| Google Rich Results Test | https://search.google.com/test/rich-results |
| Bootstrap Icons | https://icons.getbootstrap.com |
| Laravel Docs | https://laravel.com/docs/12.x |

---

*Documentation rédigée le 25 avril 2026 — mise à jour à maintenir à chaque modification structurelle.*
