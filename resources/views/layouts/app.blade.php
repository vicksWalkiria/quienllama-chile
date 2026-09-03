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
            --text-muted: #64748b;
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
            max-width: var(--content-width);
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
            gap: 0.85rem;
            white-space: nowrap;
        }

        .header-nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 8px;
            transition: all 0.2s;
            opacity: 0.92;
        }

        .header-nav a:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.18);
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
        @media (max-width: 960px) {
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
                align-items: center;
                gap: 0.5rem;
            }

            .logo {
                font-size: 1.2rem;
            }

            .menu-toggle {
                justify-self: end;
            }

            .header-search-wrapper {
                grid-column: 1 / -1;
                width: 100%;
                max-width: 100%;
                min-width: 100%;
                margin-top: 0.2rem;
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
                <a href="{{ route('area-codes.index') }}">Prefijos SUBTEL</a>
                <a href="{{ route('vcf.index') }}">Bloquear SPAM</a>
                <a href="{{ route('legal.no-molestar') }}">SERNAC No Molestar</a>
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
            </div>

            <div class="footer-col">
                <h4>Herramientas</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Buscador de Teléfonos</a></li>
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
