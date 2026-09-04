@extends('layouts.app')

@section('title', 'Quién Llama Chile App Android - Bloqueador de Pitanzas, Cuento del Tío y Spam')
@section('meta_description', 'Descarga gratis la app oficial de QuiénLlama Chile para Android en Google Play. Bloquea llamadas comerciales, cobranzas, estafas bancarias y el cuento del tío en menos de 2 ms en tu celular.')

@section('content')
<div class="app-landing">
    <!-- JSON-LD SoftwareApplication -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "SoftwareApplication",
        "name": "Quién Llama Chile",
        "operatingSystem": "ANDROID",
        "applicationCategory": "UtilitiesApplication",
        "offers": {
            "@@type": "Offer",
            "price": "0.00",
            "priceCurrency": "CLP"
        },
        "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "5.0",
            "ratingCount": "42"
        },
        "description": "Identificador y bloqueador de pitanzas, el cuento del tío, llamadas de cobranza, casas comerciales y spam telefónico en Chile.",
        "image": "{{ asset('images/app/icon_512x512.png') }}",
        "screenshot": [
            "{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}",
            "{{ asset('images/app/02_detalle_numero_comentarios.png') }}",
            "{{ asset('images/app/03_reportar_numero_sospechoso.png') }}",
            "{{ asset('images/app/05_proteccion_total_pro.png') }}"
        ],
        "downloadUrl": "https://play.google.com/store/apps/details?id=com.walkiria.quienllama",
        "author": {
            "@@type": "Person",
            "name": "Víctor Alonso",
            "url": "https://victor-alonso.es"
        }
    }
    </script>

    <!-- HERO SECTION -->
    <section class="app-hero">
        <div class="app-hero-content">
            <div class="app-badge-pill">
                <span class="pulse-dot"></span>
                <span>¡OFICIAL EN GOOGLE PLAY CHILE! 🇨🇱</span>
            </div>
            <h1 class="app-hero-title">
                Basta de pitanzas: <span class="text-gradient">identifica y frena el spam</span> en tu celular
            </h1>
            <p class="app-hero-subtitle">
                La aplicación colaborativa y oficial de <strong>QuiénLlama Chile</strong>. Detecta al instante números desconocidos, intentos de engaño telefónico ("el cuento del tío"), cobranzas insistentes y promociones de retail antes de contestar.
            </p>
            <div class="app-hero-actions">
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer" class="btn-playstore-primary" onclick="if(typeof trackGoal==='function'){trackGoal('app_download_click', {event_label:'landing_hero_cl'});}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/></svg>
                    <div>
                        <span class="btn-subtext">DISPONIBLE EN</span>
                        <span class="btn-maintext">Google Play</span>
                    </div>
                </a>
                <a href="#capturas" class="btn-secondary-outline">
                    Ver capturas de pantalla 📸
                </a>
            </div>
            <div class="app-hero-badges-list">
                <div class="mini-badge">⚡ Detección en menos de 2 ms</div>
                <div class="mini-badge">🔋 0% Consumo de batería en reposo</div>
                <div class="mini-badge">🔒 100% Privacidad (sin subir tu agenda)</div>
                <div class="mini-badge">🇨🇱 Prefijos SUBTEL (Santiago, Valparaíso, Concepción...)</div>
            </div>
        </div>
        <div class="app-hero-mockup">
            <div class="phone-frame-wrapper">
                <img src="{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}" alt="Captura App Quién Llama Chile Bloqueo de Pitanzas" class="phone-img-main" width="300" height="600" loading="eager">
                <div class="floating-stat-card">
                    <span class="stat-icon">🛡️</span>
                    <div>
                        <strong>100% Protegido</strong>
                        <span>Pitanzas bloqueadas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CARACTERÍSTICAS DESTACADAS -->
    <section class="app-features-section">
        <div class="section-heading">
            <span class="section-tag">¿POR QUÉ ELEGIRLA?</span>
            <h2>Protección efectiva contra el acoso telefónico</h2>
            <p>Diseñada a la medida de los usuarios chilenos, cubriendo las modalidades más frecuentes de llamadas no deseadas en todo el territorio nacional.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-box" style="background:#eff6ff; color:#0033a0;">
                    🚫
                </div>
                <h3>Freno a las Pitanzas y Robocalls</h3>
                <p>¿Llamadas donde contestas y nadie habla? Los call centers usan discadores automáticos para detectar líneas disponibles. QuiénLlama los identifica al primer ring para evitar que interrumpan tu día.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background:#fee2e2; color:#d52b1e;">
                    🚨
                </div>
                <h3>Alerta contra el "Cuento del Tío"</h3>
                <p>Detecta intentos de estafa que fingen ser ejecutivos de bancos (BancoEstado, Santander, Banco de Chile), falsas emergencias familiares o falsos premios de retail para evitar que caigas en engaños.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background:#fef3c7; color:#d97706;">
                    ⚖️
                </div>
                <h3>Escudo contra Cobranzas Abusivas</h3>
                <p>Si te acosan empresas de cobranza por deudas de terceros o créditos automotrices y comerciales a cualquier hora, entérate de quién llama antes de descolgar.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background:#ecfdf5; color:#059669;">
                    📍
                </div>
                <h3>Reconocimiento de Prefijos SUBTEL</h3>
                <p>Identifica el origen geográfico automático según el prefijo (Santiago +56 2, Valparaíso +56 32, Concepción +56 41, telefonía IP +56 44 y telefonía móvil +56 9).</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background:#f3e8ff; color:#7e22ce;">
                    ⚡
                </div>
                <h3>Rendimiento Ligero y Veloz</h3>
                <p>Desarrollada en Android nativo. Pesa menos de 15 MB, no ralentiza tu teléfono ni gasta tu plan de datos móviles con procesos innecesarios.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background:#f1f5f9; color:#334155;">
                    🔒
                </div>
                <h3>Tus Contactos son Privados</h3>
                <p>A diferencia de otras apps que suben tu libreta completa a internet, QuiénLlama <strong>NUNCA extrae ni almacena tus contactos</strong>. Tu privacidad es sagrada.</p>
            </div>
        </div>
    </section>

    <!-- GALERÍA DE SCREENSHOTS -->
    <section class="app-screenshots-section" id="capturas">
        <div class="section-heading">
            <span class="section-tag">INTERFAZ & EXPERIENCIA</span>
            <h2>Conoce la aplicación en tu celular</h2>
            <p>Diseño moderno, claro y compatible con modo oscuro.</p>
        </div>

        <div class="screenshots-slider-wrapper">
            <div class="screenshot-item">
                <img src="{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}" alt="Historial de llamadas y bloqueo" width="260" height="520" loading="lazy">
                <span>Historial de llamadas y bloqueos</span>
            </div>
            <div class="screenshot-item">
                <img src="{{ asset('images/app/02_detalle_numero_comentarios.png') }}" alt="Detalle del número con denuncias comunitarias" width="260" height="520" loading="lazy">
                <span>Opiniones y advertencias de la comunidad</span>
            </div>
            <div class="screenshot-item">
                <img src="{{ asset('images/app/03_reportar_numero_sospechoso.png') }}" alt="Reportar un número sospechoso" width="260" height="520" loading="lazy">
                <span>Reporta números molestos con un clic</span>
            </div>
            <div class="screenshot-item">
                <img src="{{ asset('images/app/04_seleccion_pais_cobertura.png') }}" alt="Cobertura en Chile, México, España y Argentina" width="260" height="520" loading="lazy">
                <span>Cobertura en Chile y otros países</span>
            </div>
            <div class="screenshot-item">
                <img src="{{ asset('images/app/05_proteccion_total_pro.png') }}" alt="Protección antispam total" width="260" height="520" loading="lazy">
                <span>Protección completa gratuita</span>
            </div>
            <div class="screenshot-item">
                <img src="{{ asset('images/app/06_acerca_de_privacidad.png') }}" alt="Privacidad y transparencia" width="260" height="520" loading="lazy">
                <span>Transparencia y privacidad de datos</span>
            </div>
        </div>
    </section>

    <!-- BANNER DE DESCARGA INTERMEDIO -->
    <section class="app-cta-banner">
        <div class="cta-banner-inner">
            <div class="cta-banner-text">
                <h2>¿Cansado de contestar el teléfono y que corten?</h2>
                <p>Únete a miles de personas en Chile que ya recuperaron la tranquilidad al recibir llamadas en su celular.</p>
            </div>
            <div class="cta-banner-btn-wrap">
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer" class="btn-playstore-primary" onclick="if(typeof trackGoal==='function'){trackGoal('app_download_click', {event_label:'mid_cta_cl'});}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/></svg>
                    <div>
                        <span class="btn-subtext">DESCARGAR GRATIS EN</span>
                        <span class="btn-maintext">Google Play</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="app-faq-section">
        <div class="section-heading">
            <span class="section-tag">PREGUNTAS FRECUENTES</span>
            <h2>Dudas comunes sobre la aplicación</h2>
        </div>

        <div class="faq-list">
            <details class="faq-item">
                <summary>¿La app es realmente gratuita?</summary>
                <div class="faq-answer">
                    <p>Sí, la aplicación QuiénLlama Chile es 100% gratuita. Puedes descargarla e instalarla desde Google Play sin suscripciones obligatorias ni cobros ocultos.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>¿Cómo complementa al portal "No Molestar" del SERNAC?</summary>
                <div class="faq-answer">
                    <p>La plataforma "No Molestar" del SERNAC permite registrar números para que empresas formales dejen de contactarte publicitariamente. Sin embargo, no detiene las llamadas fraudulentas, robocalls piratas ni cobranzas al margen de la norma. QuiénLlama ofrece una barrera técnica en tiempo real en tu propio teléfono para filtrar las llamadas que la regulación no alcanza a cubrir.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>¿Se suben mis contactos privados a internet?</summary>
                <div class="faq-answer">
                    <p>No. QuiénLlama respeta tu derecho a la privacidad. Tu lista de contactos se mantiene en tu equipo y jamás es transmitida ni vendida a agencias de marketing ni terceros.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>¿Qué versiones de Android son compatibles?</summary>
                <div class="faq-answer">
                    <p>La aplicación es compatible con dispositivos Android desde la versión 7.0 hasta las más recientes (Android 14 y 15), optimizada para smartphones de cualquier marca.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>¿Puedo reportar una llamada molesta?</summary>
                <div class="faq-answer">
                    <p>Sí, de manera muy rápida puedes calificar el número como spam, cobranza, intento de estafa o venta comercial, colaborando activamente con la comunidad en todo Chile.</p>
                </div>
            </details>
        </div>
    </section>

    <!-- EEAT DEVELOPER BADGE -->
    <div class="eeat-author-card" style="margin-top: 3rem;">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso" class="eeat-avatar" onerror="this.src='{{ asset('images/icon-192x192.png') }}'">
        <div class="eeat-info">
            <h4>Desarrollado con dedicación por Víctor Alonso</h4>
            <p>Ingeniero de software independiente enfocado en la defensa de la privacidad digital y la creación de herramientas abiertas para combatir el spam telefónico abusivo.</p>
            <div class="eeat-links">
                <a href="{{ route('legal.about') }}">Sobre el proyecto</a>
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer">Ficha en Google Play</a>
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">Web Oficial del Desarrollador</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.app-landing {
    max-width: var(--content-width);
    margin: 0 auto;
    padding: 1.5rem 0 3rem;
}

/* HERO SECTION */
.app-hero {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    align-items: center;
    gap: 3rem;
    padding: 2.5rem 2rem;
    background: linear-gradient(135deg, #002266 0%, #0033a0 50%, #001f4d 100%);
    border-radius: var(--radius-lg);
    color: white;
    box-shadow: 0 16px 32px rgba(0, 51, 160, 0.25);
    margin-bottom: 3.5rem;
    position: relative;
    overflow: hidden;
}

.app-hero::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(213, 43, 30, 0.22) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.app-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 6px 14px;
    border-radius: 9999px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 1.25rem;
}

.pulse-dot {
    width: 8px;
    height: 8px;
    background: #d52b1e;
    border-radius: 50%;
    box-shadow: 0 0 8px #d52b1e;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(0.95); opacity: 0.8; }
    50% { transform: scale(1.2); opacity: 1; }
    100% { transform: scale(0.95); opacity: 0.8; }
}

.app-hero-title {
    font-size: 2.6rem;
    font-weight: 900;
    line-height: 1.15;
    margin-bottom: 1.25rem;
    letter-spacing: -0.5px;
}

.text-gradient {
    background: linear-gradient(90deg, #fef08a, #fed7aa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.app-hero-subtitle {
    font-size: 1.05rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    max-width: 580px;
}

.app-hero-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.btn-playstore-primary {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #ffffff;
    color: #0f172a;
    padding: 0.75rem 1.6rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 800;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
}

.btn-playstore-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.35);
    background: #f8fafc;
}

.btn-playstore-primary svg {
    color: #0033a0;
}

.btn-subtext {
    display: block;
    font-size: 0.65rem;
    letter-spacing: 1px;
    color: #64748b;
    font-weight: 700;
}

.btn-maintext {
    display: block;
    font-size: 1.15rem;
    line-height: 1.1;
    color: #0f172a;
}

.btn-secondary-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.35);
    color: white;
    padding: 0.85rem 1.3rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    transition: background 0.2s;
}

.btn-secondary-outline:hover {
    background: rgba(255, 255, 255, 0.22);
}

.app-hero-badges-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}

.mini-badge {
    background: rgba(0, 0, 0, 0.2);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.78rem;
    font-weight: 600;
    border: 1px solid rgba(255, 255, 255, 0.15);
}

/* PHONE MOCKUP */
.app-hero-mockup {
    display: flex;
    justify-content: center;
    position: relative;
}

.phone-frame-wrapper {
    position: relative;
}

.phone-img-main {
    width: 270px;
    height: auto;
    border-radius: 28px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
    border: 6px solid rgba(255, 255, 255, 0.3);
    display: block;
}

.floating-stat-card {
    position: absolute;
    bottom: -15px;
    left: -20px;
    background: white;
    color: #0f172a;
    padding: 10px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--border);
    animation: float 4s ease-in-out infinite;
}

.floating-stat-card .stat-icon {
    font-size: 1.5rem;
}

.floating-stat-card strong {
    display: block;
    font-size: 0.88rem;
    color: #0033a0;
}

.floating-stat-card span {
    font-size: 0.75rem;
    color: var(--text-muted);
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* SECTIONS COMMONS */
.section-heading {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 2.5rem;
}

.section-tag {
    display: inline-block;
    color: var(--primary);
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.section-heading h2 {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-main);
    margin-bottom: 0.75rem;
}

.section-heading p {
    font-size: 0.95rem;
    color: var(--text-muted);
}

/* FEATURES GRID */
.app-features-section {
    margin-bottom: 4rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.feature-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.75rem;
    box-shadow: var(--shadow-sm);
    transition: transform 0.2s, box-shadow 0.2s;
}

.feature-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow);
    border-color: var(--border-hover);
}

.feature-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 1.2rem;
}

.feature-card h3 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 0.6rem;
}

.feature-card p {
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.55;
}

/* SCREENSHOTS SLIDER */
.app-screenshots-section {
    margin-bottom: 4.5rem;
}

.screenshots-slider-wrapper {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    padding: 1rem 0.5rem 2rem;
    scroll-snap-type: x mandatory;
    scrollbar-width: thin;
}

.screenshots-slider-wrapper::-webkit-scrollbar {
    height: 8px;
}

.screenshots-slider-wrapper::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.screenshot-item {
    flex: 0 0 250px;
    scroll-snap-align: center;
    text-align: center;
}

.screenshot-item img {
    width: 100%;
    height: auto;
    border-radius: 18px;
    border: 3px solid var(--border);
    box-shadow: var(--shadow);
    transition: transform 0.25s;
}

.screenshot-item:hover img {
    transform: scale(1.03);
}

.screenshot-item span {
    display: block;
    margin-top: 0.75rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-main);
}

/* CTA BANNER */
.app-cta-banner {
    background: linear-gradient(135deg, #002266 0%, #0033a0 100%);
    border-radius: var(--radius-lg);
    padding: 2.5rem 2rem;
    color: white;
    margin-bottom: 4rem;
    box-shadow: var(--shadow);
}

.cta-banner-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.cta-banner-text h2 {
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.cta-banner-text p {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
}

/* FAQ */
.app-faq-section {
    margin-bottom: 3.5rem;
}

.faq-list {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
}

.faq-item summary {
    font-weight: 700;
    font-size: 1rem;
    color: var(--text-main);
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-item summary::-webkit-details-marker {
    display: none;
}

.faq-item summary::after {
    content: '+';
    font-size: 1.3rem;
    color: var(--primary);
    font-weight: 700;
    transition: transform 0.2s;
}

.faq-item[open] summary::after {
    content: '−';
}

.faq-answer {
    padding-top: 1rem;
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.6;
    border-top: 1px solid var(--border);
    margin-top: 0.75rem;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .app-hero {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 2rem;
    }
    .app-hero-title {
        font-size: 2rem;
    }
    .app-hero-actions {
        justify-content: center;
    }
    .app-hero-badges-list {
        justify-content: center;
    }
    .cta-banner-inner {
        flex-direction: column;
        text-align: center;
    }
    .cta-banner-btn-wrap {
        width: 100%;
    }
    .cta-banner-btn-wrap .btn-playstore-primary {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
