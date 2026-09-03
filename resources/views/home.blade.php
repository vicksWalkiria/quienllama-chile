@extends('layouts.app')

@section('title', 'Quién Llama - Saber a quién pertenece un número de teléfono en Chile gratis')
@section('meta_description', 'Introduce un número de teléfono o celular y descubre gratis a quién pertenece en Chile. Identifica llamadas de spam, telemarketing, estafas y lee denuncias de la comunidad.')

@section('styles')
<style>
    /* Search Section (Estilo Clásico QuiénLlama) */
    .search-section {
        text-align: center;
        padding: 2.5rem 1rem 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .search-section h1 {
        font-size: 2.3rem;
        font-weight: 900;
        letter-spacing: -0.7px;
        color: var(--text-main);
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .search-section p {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 1.75rem;
    }

    .search-form-wrapper {
        position: relative;
        max-width: 680px;
        margin: 0 auto;
        width: 100%;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 2px solid var(--primary);
        border-radius: 9999px;
        padding: 0.35rem 0.45rem 0.35rem 1.4rem;
        box-shadow: 0 10px 25px -5px rgba(0, 51, 160, 0.2);
        transition: box-shadow 0.2s;
    }

    .search-form:focus-within {
        box-shadow: 0 12px 30px -4px rgba(0, 51, 160, 0.3);
    }

    .search-form input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        background: transparent;
    }

    .search-form .btn-search {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.8rem 1.75rem;
        border-radius: 9999px;
        font-weight: 800;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }

    .search-form .btn-search:hover {
        background: var(--primary-hover);
        transform: scale(1.02);
    }

    /* Quick Action Pills */
    .quick-actions {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .qa-pill-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: #fee2e2;
        color: #b91c1c;
        border: 1.5px solid #fca5a5;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.45rem 1.1rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .qa-pill-danger:hover {
        background: #fecdd3;
        transform: translateY(-1px);
    }

    .qa-pill-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: #eff6ff;
        color: var(--primary);
        border: 1.5px solid #bfdbfe;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.45rem 1.1rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .qa-pill-blue:hover {
        background: #dbeafe;
    }

    /* Dark VCF Banner (Centrado) */
    .vcf-promo-banner {
        max-width: 680px;
        margin: 2rem auto 0;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        border: 1px solid #334155;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 0.85rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }

    .vcf-promo-left {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        text-align: center;
    }

    .vcf-promo-icon {
        font-size: 1.8rem;
        margin-bottom: 0.1rem;
    }

    .vcf-promo-text strong {
        color: #ffffff;
        font-size: 1.05rem;
        display: block;
        margin-bottom: 0.35rem;
    }

    .vcf-promo-text span {
        color: #cbd5e1;
        font-size: 0.88rem;
        line-height: 1.45;
        max-width: 520px;
        display: block;
        margin: 0 auto;
    }

    .vcf-promo-btn {
        background: var(--secondary);
        color: white;
        text-decoration: none;
        padding: 0.6rem 1.5rem;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        white-space: nowrap;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(213, 43, 30, 0.35);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .vcf-promo-btn:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(213, 43, 30, 0.45);
    }

    /* Phone Pills Grid */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .section-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .pills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 2rem;
    }

    .phone-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.95rem;
        font-weight: 700;
        text-decoration: none;
        transition: transform 0.15s, box-shadow 0.15s, background 0.2s;
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
        font-family: inherit;
    }

    .phone-pill:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .pill-danger {
        background: #fee2e2;
        color: #b91c1c;
        border: 1.5px solid #fca5a5;
    }

    .pill-neutral {
        background: var(--surface);
        color: var(--text-main);
        border: 1.5px solid var(--border);
    }

    .pill-neutral:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .pill-badge {
        font-size: 0.78rem;
        opacity: 0.85;
    }

    /* EEAT Author Box */
    .eeat-author-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        margin-top: 3rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .eeat-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
        flex-shrink: 0;
    }

    .eeat-info h4 {
        margin: 0 0 0.35rem 0;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-main);
    }

    .eeat-info p {
        margin: 0 0 0.75rem 0;
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .eeat-links {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .eeat-links a {
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
    }

    .eeat-links a:hover {
        text-decoration: underline;
    }

    /* FAQs */
    .faqs {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-sm);
    }

    .faqs h3 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1.25rem;
    }

    .faqs details {
        border-bottom: 1px solid var(--border);
        padding: 1rem 0;
    }

    .faqs details:last-child {
        border-bottom: none;
    }

    .faqs summary {
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-main);
        cursor: pointer;
        user-select: none;
        outline: none;
    }

    .faqs summary:hover {
        color: var(--primary);
    }

    .faq-content {
        margin-top: 0.65rem;
        color: var(--text-muted);
        font-size: 0.92rem;
        line-height: 1.6;
    }

    @media (max-width: 640px) {
        .search-section {
            padding: 1.5rem 0.5rem 1.25rem;
        }
        .search-section h1 {
            font-size: 1.65rem;
            line-height: 1.25;
        }
        .search-section p {
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
        }
        .search-form {
            flex-direction: column;
            border-radius: var(--radius);
            padding: 0.5rem;
            gap: 0.5rem;
        }
        .search-form input {
            text-align: center;
            padding: 0.6rem 0.5rem;
            font-size: 1rem;
        }
        .search-form .btn-search {
            width: 100%;
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
        }
        .quick-actions {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }
        .quick-actions a {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .vcf-promo-banner {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem 1rem;
            gap: 0.85rem;
        }
        .vcf-promo-left {
            flex-direction: column;
            text-align: center;
        }
        .vcf-promo-btn {
            width: 100%;
            text-align: center;
            display: block;
        }
        .section-header {
            flex-direction: column;
            text-align: center;
            align-items: center;
            gap: 0.25rem;
        }
        .pills-grid {
            justify-content: center;
        }
        .eeat-author-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem 1rem;
            gap: 1rem;
        }
        .eeat-avatar {
            margin: 0 auto;
        }
        .faqs {
            padding: 1.25rem 1rem;
        }
        .report-cta-section form {
            flex-direction: column;
        }
        .report-cta-section button {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

    <!-- Hero Search Section -->
    <section class="search-section">
        <h1>¿A quién pertenece este número de teléfono?</h1>
        <p>Introduce cualquier número fijo o celular y descubre gratis quién te llama en Chile y si es spam o estafa.</p>

        <div class="search-form-wrapper">
            <form action="{{ route('search') }}" method="GET" class="search-form">
                <input type="tel" name="q" placeholder="Introduce el número (ej: 9 8765 4321)" autofocus required>
                <button type="submit" class="btn-search">Buscar Gratis</button>
            </form>
        </div>

        <div class="quick-actions">
            <span style="font-size: 0.85rem; color: var(--text-muted);">¿Quieres reportar o consultar una llamada?</span>
            <a href="#notificar-telefono-sospechoso" class="qa-pill-danger">
                <span>🚨</span> Notificar teléfono sospechoso <span>⬇</span>
            </a>
            <a href="{{ route('legal.no-molestar') }}" class="qa-pill-blue">
                <span>⚖️</span> SERNAC «No Molestar» ➔
            </a>
        </div>

        <!-- Banner Destacado: Bloqueador VCF -->
        <div class="vcf-promo-banner">
            <div class="vcf-promo-left">
                <span class="vcf-promo-icon">🚫</span>
                <div class="vcf-promo-text">
                    <strong>¿Cansado de recibir llamadas SPAM en tu celular?</strong>
                    <span>Bloquea cientos de números en tu teléfono en 1 clic con nuestra lista VCF gratis para Chile.</span>
                </div>
            </div>
            <a href="{{ route('vcf.index') }}" class="vcf-promo-btn">
                Ver Lista VCF ➔
            </a>
        </div>

        <!-- Banner Comunidad Telegram -->
        <div class="telegram-banner-cta" style="margin-top: 1rem; margin-bottom: 0;">
            <div class="telegram-banner-content">
                <div class="telegram-banner-icon">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="#ffffff"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                </div>
                <div class="telegram-banner-text">
                    <h3>💬 Comunidad Antispam en Telegram</h3>
                    <p>Súmate al grupo oficial de Chile. Consulta dudas, reporta llamadas comerciales y mantente protegido en tiempo real con la comunidad.</p>
                </div>
            </div>
            <a href="https://t.me/+C91vWOozJvI4NzJk" target="_blank" rel="noopener noreferrer" class="telegram-banner-btn" onclick="if(typeof trackGoal==='function'){trackGoal('join_telegram_community', {event_label:'home_banner'});}">
                <span>Unirme Gratis ➔</span>
            </a>
        </div>
    </section>

    <!-- Pills Grid: Números Investigados -->
    @if($pillsPhones->isNotEmpty())
    <section style="margin-bottom: 2.5rem;">
        <div class="section-header">
            <h2>
                <span>📞</span> Teléfonos y Celulares Reportados en Chile
            </h2>
            <span style="font-size: 0.82rem; color: var(--text-muted); font-weight: 600;">
                {{ number_format($totalPhones) }} números registrados
            </span>
        </div>

        <div class="pills-grid">
            @foreach($pillsPhones as $p)
                <a href="{{ route('phone.show', $p->number) }}" class="phone-pill {{ $p->spam_score > 0 ? 'pill-danger' : 'pill-neutral' }}">
                    <span class="pill-number">{{ $p->formatted() }}</span>
                    <span class="pill-badge">
                        {{ $p->area_code ? '📍 +' . $p->area_code : '🇨🇱' }}
                    </span>
                </a>
            @endforeach
        </div>
    </section>
    @else
    <section style="margin-bottom: 2.5rem; text-align: center; background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem 1.5rem; box-shadow: var(--shadow-sm);">
        <span style="font-size: 2.2rem; display: block; margin-bottom: 0.5rem;">🛡️</span>
        <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">
            Directorio Libre de SPAM en Construcción Colaborativa
        </h2>
        <p style="color: var(--text-muted); font-size: 0.92rem; max-width: 540px; margin: 0 auto 1.25rem; line-height: 1.5;">
            Solo publicamos reportes y teléfonos verificados por la comunidad. Si recibiste una llamada sospechosa en Chile, búscalo arriba o notifícalo para alertar a otros usuarios.
        </p>
        <a href="{{ route('area-codes.index') }}" class="btn btn-outline" style="font-size: 0.88rem; padding: 0.5rem 1.2rem; display:inline-flex; align-items:center; gap:6px;">
            <span>📍</span> Ver Directorio de Prefijos Regionales (SUBTEL) ➔
        </a>
    </section>
    @endif

    <!-- Guía de Estafas Frecuentes en Chile -->
    <section style="background:linear-gradient(135deg, #1e293b, #0f172a); color:white; border-radius:var(--radius-lg); padding:2rem; margin-bottom:3rem; box-shadow:var(--shadow-hover)">
        <h2 style="font-size:1.45rem; font-weight:800; margin-bottom:0.6rem">
            🛡️ Radar de Estafas Telefónicas en Chile
        </h2>
        <p style="color:#94a3b8; font-size:0.92rem; line-height:1.6; margin-bottom:1.5rem">
            Recomendaciones prácticas para no caer en engaños comunes originados desde líneas virtuales VoIP o números móviles:
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(230px, 1fr)); gap:1rem">
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">📦 Falso BancoEstado / Falabella</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Alertan por supuestos bloqueos de CuentaRUT o compras no reconocidas mediante SMS con enlaces maliciosos.</p>
            </div>
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">💬 Clonación de WhatsApp</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Piden el código de 6 dígitos con excusas de paquetes de encomiendas o turnos médicos. Nunca lo compartas.</p>
            </div>
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">🔇 Llamadas Fantasma / Wangiri</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Marcadores automáticos que cortan al contestar para chequear si tu celular está activo y derivarlo a telemarketing.</p>
            </div>
        </div>
    </section>

    <!-- FAQs Schema.org -->
    <section class="faqs" itemscope itemtype="https://schema.org/FAQPage">
        <h3>Preguntas Frecuentes</h3>
        
        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Qué debo hacer si recibo llamadas de spam constantemente en mi celular?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Si recibes llamadas recurrentes en Chile, lo más recomendable es bloquear el número desde los ajustes de tu celular o descargar nuestra lista VCF gratis. Además, puedes buscar el número en nuestra plataforma para comprobar si otros usuarios lo reportaron y dejar tu denuncia.</p>
            </div>
        </details>
        
        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Cómo inscribo mi teléfono en «No Molestar» del SERNAC?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Puedes inscribir tus líneas fijas y celulares de forma gratuita en el portal oficial del SERNAC (sernac.cl) utilizando tu ClaveÚnica. Las empresas notificadas disponen de 1 día hábil para dejar de contactarte bajo apercibimiento de multas de hasta 300 UTM.</p>
            </div>
        </details>

        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Cómo recopilan la información de los números en QuiénLlama?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Nuestra plataforma se basa en la colaboración ciudadana. Los usuarios reportan los motivos de las llamadas recibidas y comparten sus experiencias para advertir a la comunidad sobre números sospechosos o insistentes.</p>
            </div>
        </details>
    </section>

    <!-- Report CTA Form Section -->
    <section class="report-cta-section" id="notificar-telefono-sospechoso" style="scroll-margin-top: 5rem;">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <span style="font-size: 2rem;">🚨</span>
            <h2 style="font-size: 1.4rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                Notificar un Teléfono Sospechoso
            </h2>
            <p style="font-size: 0.92rem; color: var(--text-muted);">
                Ingresa el número que te llamó para buscar su ficha o crearla automáticamente y advertir a otros usuarios en Chile.
            </p>
        </div>

        <div style="max-width: 500px; margin: 0 auto;">
            <form action="{{ route('search') }}" method="GET" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <input type="tel" name="q" placeholder="Número sospechoso (ej: 9 8765 4321)" required style="flex: 1; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 1rem; min-width: 200px;">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.25rem;">
                    Identificar y Reportar
                </button>
            </form>
        </div>
    </section>

    <!-- EEAT Author Card (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso - Desarrollador y Especialista SEO" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Revisado y verificado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección comunitaria frente a fraudes y spam telefónico en Chile, España y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="{{ route('legal.about') }}">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>

@endsection
