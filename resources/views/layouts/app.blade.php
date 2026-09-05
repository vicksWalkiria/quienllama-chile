<!DOCTYPE html>
<html lang="es-CL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quién Llama Chile - ¿De quién es este número? Identificador Gratis')</title>
    <meta name="description" content="@yield('meta_description', 'Descubre gratis quién te llama en Chile. Identificador comunitario de celulares y números fijos, denuncias de spam, estafas telefónicas y telemarketing.')">
    <meta name="theme-color" content="#0033a0">
    <meta name="apple-mobile-web-app-title" content="QuiénLlama Chile">
    <link rel="canonical" href="{{ url()->current() }}">

    @if(request()->is('/') || request()->is('bloquear-spam*') || request()->is('sobre-*') || request()->is('contacto*') || request()->is('no-molestar*'))
    <!-- Hreflang Internacional QuiénLlama Network -->
    <link rel="alternate" hreflang="es-ES" href="https://quienllama.com.es/{{ request()->path() === '/' ? '' : (request()->is('bloquear-spam*') ? 'bloquear-spam-vcf/' : (request()->is('sobre-*') ? 'sobre-nosotros/' : (request()->is('contacto*') ? 'contacto/' : ''))) }}">
    <link rel="alternate" hreflang="es-MX" href="https://mx.quienllama.com.es/{{ request()->path() === '/' ? '' : (request()->is('bloquear-spam*') ? 'bloquear-spam-masivo' : (request()->is('sobre-*') ? 'sobre-mi' : (request()->is('contacto*') ? 'contacto' : (request()->is('no-molestar*') ? 'no-molestar' : '')))) }}">
    <link rel="alternate" hreflang="es-CL" href="https://cl.quienllama.com.es/{{ request()->path() === '/' ? '' : (request()->is('bloquear-spam*') ? 'bloquear-spam-masivo' : (request()->is('sobre-*') ? 'sobre-mi' : (request()->is('contacto*') ? 'contacto' : (request()->is('no-molestar*') ? 'no-molestar' : '')))) }}">
    <link rel="alternate" hreflang="es-AR" href="https://ar.quienllama.com.es/{{ request()->path() === '/' ? '' : (request()->is('bloquear-spam*') ? 'bloquear-spam-masivo' : (request()->is('sobre-*') ? 'sobre-mi' : (request()->is('contacto*') ? 'contacto' : (request()->is('no-molestar*') ? 'no-molestar' : '')))) }}">
    <link rel="alternate" hreflang="x-default" href="https://quienllama.com.es/{{ request()->path() === '/' ? '' : (request()->is('bloquear-spam*') ? 'bloquear-spam-vcf/' : (request()->is('sobre-*') ? 'sobre-nosotros/' : (request()->is('contacto*') ? 'contacto/' : ''))) }}">
    @endif
    
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_CL">
    <meta property="og:site_name" content="QuiénLlama Chile">
    <meta property="og:title" content="@yield('title', 'Quién Llama Chile - ¿De quién es este número?')">
    <meta property="og:description" content="@yield('meta_description', 'Descubre gratis quién te llama en Chile. Identificador comunitario de celulares y números fijos, denuncias de spam y estafas.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:secure_url" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="535">
    <meta property="og:image:alt" content="QuiénLlama Chile - ¡Acaba con el SPAM!">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@vicksWalkiria">
    <meta name="twitter:creator" content="@vicksWalkiria">
    <meta name="twitter:title" content="@yield('title', 'Quién Llama Chile - ¿De quién es este número?')">
    <meta name="twitter:description" content="@yield('meta_description', 'Descubre gratis quién te llama en Chile. Identificador comunitario de celulares y números fijos, denuncias de spam y estafas.')">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">
    <meta name="twitter:image:alt" content="QuiénLlama Chile - ¡Acaba con el SPAM!">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/icon-512x512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192x192.png') }}">

    <!-- Search Engine Verification (Google & Bing) -->
    <meta name="google-site-verification" content="8d29c2442fb48502">
    <meta name="google-site-verification" content="a4c4eb519aa0b080">
    <meta name="msvalidate.01" content="4FB9070697157F7FC512923BE9B02FC5">

    <!-- LLMs.txt AI Discovery -->
    <link rel="alternate" type="text/plain" href="{{ url('/llms.txt') }}" title="Documentación para LLMs e IA">

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Schema.org Organization & EEAT Author -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "QuiénLlama Chile",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/icon-512x512.png') }}",
        "founder": {
            "@@type": "Person",
            "name": "Víctor Alonso",
            "url": "https://victor-alonso.es",
            "jobTitle": "Full-Stack Developer & SEO Specialist",
            "image": "{{ asset('images/victor-alonso.webp') }}",
            "sameAs": [
                "https://victor-alonso.es",
                "https://www.linkedin.com/in/vialonso/",
                "https://github.com/vicksWalkiria"
            ]
        }
    }
    </script>

    @php
        $gaId = config('services.analytics.ga_id', env('GA_MEASUREMENT_ID', 'G-0FQMZEG2Q6'));
        $clarityId = config('services.analytics.clarity_id', env('CLARITY_ID', 'y3vm0et5be'));
    @endphp

    <!-- Google tag (gtag.js) GA4 Optimizado y No Bloqueante (CWV 100) -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');

        function loadGTM() {
            if (!window.gtmLoaded) {
                window.gtmLoaded = true;
                var s = document.createElement('script');
                s.src = 'https://www.googletagmanager.com/gtag/js?id={{ $gaId }}';
                s.async = true;
                document.head.appendChild(s);
            }
        }
        if ('requestIdleCallback' in window) {
            requestIdleCallback(function() { setTimeout(loadGTM, 1500); });
        } else {
            window.addEventListener('load', function() { setTimeout(loadGTM, 1500); });
        }
        ['scroll', 'touchstart', 'mousemove', 'click', 'keydown'].forEach(function(e) {
            window.addEventListener(e, loadGTM, {once: true, passive: true});
        });
    </script>

    <!-- Microsoft Clarity Optimizado -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "{{ $clarityId }}");
    </script>

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8445861106914741" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary: #0033a0; /* Azul Bandera Chilena */
            --primary-hover: #002266; /* Azul profundo */
            --secondary: #d52b1e; /* Rojo Chileno */
            --accent-red: #d52b1e;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border: #e2e8f0;
            --border-hover: #cbd5e1;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --radius: 12px;
            --radius-lg: 18px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* Layout widths — single source of truth */
            --content-width: 1150px;
            --content-narrow: 760px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text-main);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Header Premium (Estilo QuiénLlama) */
        .site-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 0.75rem 1.25rem;
            color: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1380px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            width: 100%;
        }

        .logo {
            color: white;
            text-decoration: none;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            transition: transform 0.2s;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo-icon {
            font-size: 1.4rem;
        }

        .tld-badge {
            font-size: 0.78rem;
            background: rgba(255, 255, 255, 0.22);
            padding: 3px 10px;
            border-radius: 9999px;
            font-weight: 700;
            letter-spacing: 0.2px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Top Search Bar (Amplia y siempre visible) */
        .header-search-wrapper {
            flex: 1;
            max-width: 520px;
            min-width: 220px;
        }

        .header-search-form {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .header-search-form input {
            width: 100%;
            padding: 0.6rem 2.5rem 0.6rem 1.1rem;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.96);
            font-size: 0.92rem;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header-search-form input:focus {
            background: #ffffff;
            border-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.35);
        }

        .header-search-form button {
            position: absolute;
            right: 8px;
            background: transparent;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            color: var(--primary);
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Nav links */
        .header-nav {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            white-space: nowrap;
        }

        .header-nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.86rem;
            font-weight: 600;
            padding: 4px 7px;
            border-radius: 8px;
            transition: all 0.2s;
            opacity: 0.92;
        }

        .header-nav a:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.18);
        }

        .nav-tg-mobile, .nav-sernac-mobile, .nav-pref-mobile {
            display: none;
        }
        .nav-tg-desktop, .nav-sernac-desktop, .nav-pref-desktop {
            display: inline;
        }

        @media (min-width: 1081px) and (max-width: 1250px) {
            .header-search-wrapper {
                max-width: 250px;
            }
            .header-nav {
                gap: 0.4rem;
            }
            .header-nav a {
                font-size: 0.82rem;
                padding: 3px 5px;
            }
        }

        .header-nav a.nav-btn-highlight {
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid rgba(255, 255, 255, 0.4);
            opacity: 1;
        }

        .header-nav a.nav-btn-highlight:hover {
            background: #ffffff;
            color: var(--primary);
        }

        /* Mobile Menu Toggle Button */
        .menu-toggle {
            display: none;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 6px;
            flex-direction: column;
            gap: 5px;
            z-index: 110;
        }

        .menu-toggle .bar {
            width: 24px;
            height: 3px;
            background-color: white;
            border-radius: 3px;
            transition: all 0.3s ease-in-out;
        }

        .menu-toggle.active .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* Container */
        .container {
            max-width: var(--content-width);
            margin: 0 auto;
            padding: 2rem 1.25rem;
            flex: 1;
            width: 100%;
        }

        /* Utility layout classes */
        .content-narrow {
            width: 100%;
            max-width: var(--content-narrow);
            margin: 0 auto;
        }

        .content-tool {
            width: 100%;
            max-width: var(--content-width);
            margin: 0 auto;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /* Buttons & Forms */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 3px 10px rgba(227, 0, 15, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-main);
        }

        .btn-outline:hover {
            background: var(--surface);
            border-color: var(--border-hover);
        }

        .nav-telegram-btn {
            background: #006699 !important;
            color: #ffffff !important;
            padding: 0.45rem 0.95rem !important;
            border-radius: 9999px !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.35rem !important;
            box-shadow: 0 2px 6px rgba(0, 102, 153, 0.35) !important;
            text-decoration: none !important;
            transition: transform 0.15s, background 0.15s !important;
        }
        .nav-telegram-btn:hover {
            background: #004d73 !important;
            transform: translateY(-1px) !important;
        }
        .footer-telegram-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #006699 !important;
            color: #ffffff !important;
            padding: 8px 16px;
            border-radius: 9999px;
            font-weight: 700;
            text-decoration: none !important;
            font-size: 0.86rem;
            margin-top: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 102, 153, 0.25);
            transition: transform 0.15s, background 0.15s;
        }
        .footer-telegram-btn:hover {
            background: #004d73 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        /* Community Telegram Banner CTA */
        .telegram-banner-cta {
            background: linear-gradient(135deg, #0088cc 0%, #006699 100%);
            border-radius: var(--radius-lg);
            padding: 1.35rem 1.6rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.35rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px -5px rgba(0, 136, 204, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .telegram-banner-content {
            display: flex;
            align-items: center;
            gap: 1.15rem;
        }
        .telegram-banner-icon {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .telegram-banner-text h3,
        .telegram-banner-text .telegram-banner-title {
            color: #ffffff !important;
            font-size: 1.15rem;
            font-weight: 800;
            margin: 0 0 0.25rem !important;
            letter-spacing: -0.3px;
        }
        .telegram-banner-text p {
            color: rgba(255, 255, 255, 0.95) !important;
            font-size: 0.88rem !important;
            margin: 0 !important;
            line-height: 1.45 !important;
            max-width: 620px;
        }
        .telegram-banner-btn {
            background: #ffffff;
            color: #005b8e !important;
            font-weight: 800;
            font-size: 0.92rem;
            padding: 0.8rem 1.35rem;
            border-radius: 9999px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.15s, background 0.15s, box-shadow 0.15s;
            flex-shrink: 0;
        }
        .telegram-banner-btn:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }
        /* Google Funding Choices CMP A11y Contrast Overrides */
        html body div.fc-consent-root .fc-dialog,
        html body div.fc-consent-root .fc-dialog-content,
        html body div.fc-consent-root .fc-dialog-scrollable-content,
        html body div.fc-consent-root .fc-footer,
        html body div.fc-consent-root .fc-footer p {
            background-color: #ffffff !important;
        }
        html body div.fc-consent-root .fc-faq-header,
        html body div.fc-consent-root .fc-faq-header .fc-faq-label {
            color: #0f172a !important;
            background-color: #ffffff !important;
        }
        html body div.fc-consent-root .fc-footer a,
        html body div.fc-consent-root a.fc-vendors-list-dialog,
        html body div.fc-consent-root .fc-footer-link-v2 {
            color: #0f172a !important;
            background-color: #ffffff !important;
        }
        html body div.fc-consent-root .fc-cta-manage-options,
        html body div.fc-consent-root .fc-manage-options-third-button,
        html body div.fc-consent-root .fc-manage-options-third-button-label {
            background-color: #ffffff !important;
            color: #005b8e !important;
        }
        @media (max-width: 768px) {
            .telegram-banner-cta {
                flex-direction: column;
                align-items: stretch;
                padding: 1.25rem 1rem;
                gap: 1rem;
            }
            .telegram-banner-content {
                align-items: flex-start;
                gap: 0.85rem;
            }
            .telegram-banner-icon {
                width: 44px;
                height: 44px;
                border-radius: 10px;
            }
            .telegram-banner-icon svg {
                width: 26px;
                height: 26px;
            }
            .telegram-banner-text h3,
            .telegram-banner-text .telegram-banner-title {
                font-size: 1.05rem;
            }
            .telegram-banner-text p {
                font-size: 0.84rem;
            }
            .telegram-banner-btn {
                justify-content: center;
                width: 100%;
                padding: 0.75rem 1rem;
            }
        }

        /* Footer Clásico QuiénLlama */
        .site-footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 3.5rem 1.5rem 1.5rem;
            margin-top: auto;
        }

        .footer-grid {
            max-width: var(--content-width);
            margin: 0 auto 3rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem;
        }

        .footer-col h4 {
            font-size: 0.92rem;
            font-weight: 800;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1.1rem;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .footer-col a {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.88rem;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: var(--primary);
        }

        .footer-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fee2e2;
            color: var(--primary);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 9999px;
            margin-top: 1rem;
        }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 1.5rem;
            max-width: var(--content-width);
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 0.85rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        /* EEAT Author Box Global Component */
        .eeat-author-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            box-shadow: var(--shadow-sm);
        }

        .eeat-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
            flex-shrink: 0;
        }

        .eeat-info h4 {
            font-size: 0.98rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.2rem;
        }

        .eeat-info p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 0.4rem;
        }

        .eeat-links {
            font-size: 0.82rem;
            display: flex;
            gap: 0.75rem;
        }

        .eeat-links a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .eeat-links a:hover {
            text-decoration: underline;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1080px) {
            .menu-toggle {
                display: flex;
            }

            .header-nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #0f172a;
                flex-direction: column;
                padding: 1.25rem;
                box-shadow: var(--shadow-hover);
                z-index: 105;
                gap: 0.5rem;
            }

            .header-nav.active {
                display: flex;
            }

            .nav-tg-desktop, .nav-sernac-desktop, .nav-pref-desktop {
                display: none;
            }
            .nav-tg-mobile, .nav-sernac-mobile, .nav-pref-mobile {
                display: inline;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .site-header {
                padding: 0.6rem 0.85rem;
            }

            .header-inner {
                display: grid;
                grid-template-columns: 1fr auto;
                grid-template-areas:
                    "logo toggle"
                    "search search";
                align-items: center;
                gap: 0.6rem 0.5rem;
            }

            .logo {
                grid-area: logo;
                font-size: 1.2rem;
            }

            .menu-toggle {
                grid-area: toggle;
                justify-self: end;
            }

            .header-search-wrapper {
                grid-area: search;
                width: 100%;
                max-width: 100%;
                min-width: 100%;
                margin-top: 0;
            }

            /* EEAT Author Card Mobile Responsive */
            .eeat-author-card {
                flex-direction: column !important;
                text-align: center !important;
                padding: 1.25rem 1rem !important;
                gap: 0.85rem !important;
                align-items: center !important;
            }

            .eeat-avatar {
                margin: 0 auto !important;
                width: 68px !important;
                height: 68px !important;
            }

            .eeat-info {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                width: 100% !important;
            }

            .eeat-info h4 {
                margin-bottom: 0.35rem !important;
                font-size: 0.96rem !important;
            }

            .eeat-info p {
                font-size: 0.84rem !important;
                line-height: 1.45 !important;
                margin-bottom: 0.6rem !important;
            }

            .eeat-links {
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 0.5rem 1rem !important;
                width: 100% !important;
            }

            .container {
                padding: 1.25rem 0.85rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1.75rem;
            }

            .footer-col {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .footer-col ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .footer-bottom {
                text-align: center;
            }

            .footer-bottom-inner {
                flex-direction: column;
                text-align: center;
                justify-content: center;
                gap: 0.75rem;
            }
        }
        /* Global App Android Banner Chile */
        .app-global-banner-cl {
            background: linear-gradient(135deg, #021a40 0%, #0033a0 50%, #001f4d 100%);
            border: 1.5px solid #60a5fa;
            border-radius: 18px;
            padding: 1.25rem 1.6rem;
            margin: 1.25rem auto 1.75rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            box-shadow: 0 10px 28px -6px rgba(0, 51, 160, 0.4), 0 4px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
        }
        .app-global-banner-cl::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            background: radial-gradient(circle, rgba(213, 43, 30, 0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        .app-banner-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex: 1;
        }
        .app-banner-icon-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .app-banner-logo {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(96, 165, 250, 0.4);
            display: block;
        }
        .app-banner-verif {
            position: absolute;
            bottom: -3px;
            right: -3px;
            background: #2563eb;
            color: #ffffff;
            font-size: 11px;
            font-weight: 900;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #021a40;
        }
        .app-banner-info {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .app-banner-badge-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .app-banner-chip {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
        }
        .app-chip-free {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.4);
        }
        .app-chip-privacy {
            background: rgba(96, 165, 250, 0.2);
            color: #93c5fd;
            border: 1px solid rgba(96, 165, 250, 0.4);
        }
        .app-banner-title {
            font-size: 1.12rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            line-height: 1.3;
        }
        .app-banner-desc {
            font-size: 0.86rem;
            color: rgba(255, 255, 255, 0.88);
            margin: 0;
            line-height: 1.4;
        }
        .app-banner-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .btn-app-playstore {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #0f172a;
            color: #ffffff !important;
            padding: 9px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-app-playstore:hover {
            background: #1e293b;
            border-color: #60a5fa;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 51, 160, 0.4);
            color: #ffffff !important;
        }
        .btn-app-playstore-txt {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.1;
        }
        .btn-app-sub {
            font-size: 0.58rem;
            letter-spacing: 0.08em;
            opacity: 0.8;
            font-weight: 600;
            color: #94a3b8;
        }
        .btn-app-main {
            font-size: 0.98rem;
            font-weight: 800;
            color: #ffffff;
        }
        .btn-app-learnmore {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff !important;
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-app-learnmore:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: #60a5fa;
            color: #93c5fd !important;
        }
        .nav-app-link {
            background: rgba(37, 99, 235, 0.2) !important;
            border: 1.5px solid #2563eb !important;
            color: #93c5fd !important;
            font-weight: 800 !important;
            border-radius: 9999px !important;
            padding: 0.35rem 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.35rem !important;
            transition: all 0.2s ease !important;
        }
        .nav-app-link:hover {
            background: #2563eb !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
        }
        @media (max-width: 900px) {
            .app-global-banner-cl {
                flex-direction: column;
                align-items: stretch;
                padding: 1.1rem 1.15rem 1rem;
                gap: 0.75rem;
                border-radius: 16px;
                margin: 0.85rem auto 1.35rem;
            }
            .app-banner-left {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                gap: 0.85rem;
                width: 100%;
            }
            .app-banner-icon-wrap {
                flex-shrink: 0;
                margin-top: 2px;
            }
            .app-banner-logo {
                width: 52px;
                height: 52px;
                border-radius: 13px;
            }
            .app-banner-verif {
                width: 17px;
                height: 17px;
                font-size: 9px;
                bottom: -2px;
                right: -2px;
            }
            .app-banner-info {
                display: flex;
                flex-direction: column;
                gap: 0.25rem;
                flex: 1;
                min-width: 0;
            }
            .app-banner-badge-row {
                gap: 0.35rem;
                margin-bottom: 0.1rem;
            }
            .app-banner-chip {
                font-size: 0.68rem;
                padding: 1px 6px;
                border-radius: 5px;
            }
            .app-banner-title {
                font-size: 0.98rem;
                font-weight: 800;
                line-height: 1.25;
            }
            .app-banner-desc {
                font-size: 0.82rem;
                line-height: 1.35;
                margin: 0;
                opacity: 0.92;
            }
            .app-banner-actions {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 0.55rem !important;
                width: 100% !important;
                margin-top: 0.25rem !important;
            }
            .btn-app-playstore {
                width: 100% !important;
                box-sizing: border-box !important;
                padding: 8px 8px !important;
                border-radius: 11px !important;
                gap: 6px !important;
                justify-content: center !important;
                min-height: 42px !important;
            }
            .btn-app-playstore svg {
                width: 18px !important;
                height: 18px !important;
                flex-shrink: 0 !important;
            }
            .btn-app-playstore-txt {
                line-height: 1.05 !important;
            }
            .btn-app-sub {
                font-size: 0.52rem !important;
            }
            .btn-app-main {
                font-size: 0.84rem !important;
            }
            .btn-app-learnmore {
                width: 100% !important;
                box-sizing: border-box !important;
                padding: 8px 8px !important;
                border-radius: 11px !important;
                font-size: 0.82rem !important;
                justify-content: center !important;
                text-align: center !important;
                min-height: 42px !important;
                gap: 4px !important;
            }
        }
        @media (max-width: 480px) {
            .app-global-banner-cl {
                padding: 0.9rem 0.9rem 0.85rem;
                gap: 0.65rem;
            }
            .app-banner-logo {
                width: 46px;
                height: 46px;
                border-radius: 11px;
            }
            .app-banner-title {
                font-size: 0.92rem;
            }
            .app-banner-desc {
                font-size: 0.78rem;
                line-height: 1.3;
            }
            .btn-app-main {
                font-size: 0.80rem !important;
            }
            .btn-app-learnmore {
                font-size: 0.78rem !important;
                padding: 7px 6px !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header Navigation -->
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon">📞</span>
                QuiénLlama
                <span class="tld-badge">🇨🇱 Chile</span>
            </a>

            <!-- Header Search Box (Ampliada y siempre presente) -->
            <div class="header-search-wrapper">
                <form action="{{ route('search') }}" method="GET" class="header-search-form">
                    <input type="text" name="q" placeholder="Buscar celular o teléfono fijo (ej: 9 8765 4321)..." value="{{ request('q') }}" autocomplete="off" required>
                    <button type="submit" aria-label="Buscar">🔍</button>
                </form>
            </div>

            <!-- Mobile Hamburger Toggle -->
            <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menú">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <!-- Nav Links -->
            <nav class="header-nav" id="header-nav">
                <a href="{{ route('home') }}">Buscar</a>
                <a href="{{ route('area-codes.index') }}"><span class="nav-pref-desktop">Prefijos</span><span class="nav-pref-mobile">Prefijos SUBTEL</span></a>
                <a href="{{ route('vcf.index') }}">Bloquear SPAM</a>
                <a href="{{ url('/app') }}" style="color: #fef08a; font-weight:800; display:inline-flex; align-items:center; gap:4px;" onclick="if(typeof trackGoal==='function'){trackGoal('app_nav_click', {event_label:'header_nav_cl'});}">📲 App Android</a>
                <a href="https://t.me/+C91vWOozJvI4NzJk" target="_blank" rel="noopener noreferrer" class="nav-telegram-btn" onclick="if(typeof trackGoal==='function'){trackGoal('join_telegram_community', {event_label:'header_nav'});}">
                    <span class="nav-tg-desktop">💬 Telegram</span>
                    <span class="nav-tg-mobile">💬 Únete a la comunidad</span>
                </a>
                <a href="{{ route('legal.no-molestar') }}"><span class="nav-sernac-desktop">No Molestar</span><span class="nav-sernac-mobile">SERNAC No Molestar</span></a>
                <a href="{{ route('legal.about') }}">Sobre mí</a>
                <a href="{{ route('contact.index') }}" class="nav-btn-highlight">Contacto</a>
            </nav>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.getElementById('menu-toggle');
        var nav = document.getElementById('header-nav');
        if (toggle && nav) {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                toggle.classList.toggle('active');
                nav.classList.toggle('active');
            });
            document.addEventListener('click', function(e) {
                if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                    toggle.classList.remove('active');
                    nav.classList.remove('active');
                }
            });
        }
    });
    </script>

    <!-- Main Container -->
    <main class="container">
        @if(!request()->is('app*'))
        <aside class="app-global-banner-cl" aria-label="Descargar aplicación oficial Quién Llama para Android">
            <div class="app-banner-left">
                <div class="app-banner-icon-wrap">
                    <img src="{{ asset('images/app/icon_512x512.png') }}" alt="App Quién Llama Android" width="62" height="62" class="app-banner-logo" loading="lazy">
                    <span class="app-banner-verif" title="App Oficial Verificada">✓</span>
                </div>
                <div class="app-banner-info">
                    <div class="app-banner-badge-row">
                        <span class="app-banner-chip" style="background:#d52b1e; color:#ffffff; border:1px solid rgba(255,255,255,0.35);">🇨🇱 ¡YA EN GOOGLE PLAY!</span>
                        <span class="app-banner-chip" style="background:rgba(0,0,0,0.35); color:#fef08a; border:1px solid rgba(254,240,138,0.35);">⭐ 5.0</span>
                        <span class="app-banner-chip app-chip-free">100% Gratis</span>
                        <span class="app-banner-chip app-chip-privacy">🔒 0% Contactos</span>
                    </div>
                    <h2 class="app-banner-title">
                        ¿Aburrido de las pitanzas y el cuento del tío? ¡Instala la App Oficial!
                    </h2>
                    <p class="app-banner-desc">
                        Identifica llamadas sospechosas, frena estafas telefónicas y consulta prefijos chilenos en tiempo real directo en tu celular.
                    </p>
                </div>
            </div>
            <div class="app-banner-actions">
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer" class="btn-app-playstore" onclick="if(typeof trackGoal==='function'){trackGoal('app_download_click', {event_label:'global_banner_cl', destination:'playstore'});}">
                    <svg viewBox="0 0 512 512" width="22" height="22" fill="currentColor" aria-hidden="true">
                        <path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
                    </svg>
                    <div class="btn-app-playstore-txt">
                        <span class="btn-app-sub">INSTALAR DESDE</span>
                        <span class="btn-app-main">Google Play</span>
                    </div>
                </a>
                <a href="{{ url('/app') }}" class="btn-app-learnmore" onclick="if(typeof trackGoal==='function'){trackGoal('app_learn_more_click', {event_label:'global_banner_cl'});}">
                    <span>Conoce la App</span>
                    <span>➔</span>
                </a>
            </div>
        </aside>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span>⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Clásico QuiénLlama con EEAT -->
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="logo" style="color:var(--text-main); margin-bottom:0.75rem">
                    <span style="font-size:1.5rem">📞</span> Quién<strong>Llama</strong>
                    <span class="tld-badge" style="background:#eff6ff; color:var(--primary); border:1px solid #bfdbfe">🇨🇱 Chile</span>
                </div>
                <p style="color:var(--text-muted); font-size:0.88rem; line-height:1.6; max-width:340px; margin-bottom:1rem">
                    El directorio antispam colaborativo de Chile. Identifica llamadas desconocidas, bloquea números comerciales molestos gratis y conoce tus derechos ante el portal No Molestar del SERNAC.
                </p>
                <div class="footer-badge" style="background:#eff6ff; color:var(--primary);">
                    <span>🇨🇱 Cobertura Nacional SUBTEL 2026</span>
                </div>
                <div style="margin-top:0.85rem">
                    <a href="https://t.me/+C91vWOozJvI4NzJk" target="_blank" rel="noopener noreferrer" class="footer-telegram-btn" onclick="if(typeof trackGoal==='function'){trackGoal('join_telegram_community', {event_label:'footer'});}">
                        <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                        Únete a la comunidad en Telegram
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Herramientas</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Buscador de Teléfonos</a></li>
                    <li><a href="{{ url('/app') }}" style="color:var(--primary); font-weight:700" onclick="if(typeof trackGoal==='function'){trackGoal('app_nav_click', {event_label:'footer_cl'});}">📲 App Android (Google Play)</a></li>
                    <li><a href="{{ route('area-codes.index') }}" style="color:var(--primary); font-weight:700">Prefijos y Códigos de Área</a></li>
                    <li><a href="{{ route('vcf.index') }}">Bloqueador SPAM VCF (Top Chile)</a></li>
                    <li><a href="{{ route('legal.no-molestar') }}">Plataforma SERNAC No Molestar</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Regiones y Prefijos</h4>
                <ul>
                    <li><a href="{{ route('area-codes.show', '2') }}">Santiago y Metropolitana (+56 2)</a></li>
                    <li><a href="{{ route('area-codes.show', '32') }}">Valparaíso y Viña (+56 32)</a></li>
                    <li><a href="{{ route('area-codes.show', '41') }}">Concepción y Biobío (+56 41)</a></li>
                    <li><a href="{{ route('area-codes.show', '55') }}">Antofagasta y Calama (+56 55)</a></li>
                    <li><a href="{{ route('area-codes.show', '51') }}">La Serena y Coquimbo (+56 51)</a></li>
                    <li><a href="{{ route('area-codes.show', '45') }}">Temuco y Araucanía (+56 45)</a></li>
                    <li><a href="{{ route('area-codes.show', '65') }}">Puerto Montt (+56 65)</a></li>
                    <li><a href="{{ route('area-codes.show', '44') }}">Telefonía IP / VoIP (+56 44)</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>QuiénLlama & Legal</h4>
                <ul>
                    <li><a href="{{ route('legal.about') }}" style="color:var(--primary); font-weight:700">Sobre el Desarrollador (EEAT)</a></li>
                    <li><a href="{{ route('contact.index') }}">Contacto y Soporte</a></li>
                    <li><a href="{{ route('legal.terminos') }}">Aviso Legal y Términos</a></li>
                    <li><a href="{{ route('legal.privacidad') }}">Política de Privacidad</a></li>
                    <li><a href="{{ route('legal.cookies') }}">Política de Cookies</a></li>
                    <li><a href="{{ url('/llms.txt') }}">Documentación AI (llms.txt)</a></li>
                    <li><a href="https://quienllama.com.es/" target="_blank" rel="noopener" style="color:var(--primary); font-weight:700">🇪🇸 QuiénLlama España</a></li>
                    <li><a href="https://mx.quienllama.com.es/" target="_blank" rel="noopener" style="color:var(--primary); font-weight:700">🇲🇽 QuiénLlama México</a></li>
                    <li><a href="https://ar.quienllama.com.es/" target="_blank" rel="noopener" style="color:var(--primary); font-weight:700">🇦🇷 QuiénLlama Argentina</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; max-width:var(--content-width); margin:0 auto;">
                <div>
                    &copy; {{ date('Y') }} <strong>QuiénLlama Chile</strong> · Red QuiénLlama: <a href="https://quienllama.com.es/" target="_blank" rel="noopener" style="font-weight:700; color:inherit; text-decoration:underline">🇪🇸 España</a> | <a href="https://mx.quienllama.com.es/" target="_blank" rel="noopener" style="font-weight:700; color:inherit; text-decoration:underline">🇲🇽 México</a> | <a href="https://ar.quienllama.com.es/" target="_blank" rel="noopener" style="font-weight:700; color:inherit; text-decoration:underline">🇦🇷 Argentina</a> · Proyecto comunitario desarrollado por <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">Víctor Alonso</a>
                </div>
                <div style="display:flex; gap:0.5rem; flex-wrap:wrap; justify-content:center;">
                    <span>100% Gratuito</span> · <span>0% Batería / RAM</span> · <span>100% Privacidad</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- GA4 & sendBeacon Hybrid Event Tracker -->
    <script src="{{ asset('js/analytics_events.js') }}" defer></script>

    @yield('scripts')
</body>
</html>
