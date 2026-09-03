@extends('layouts.app')

@section('title', 'Directorio de Códigos de Área y Prefijos Telefónicos de Chile (SUBTEL)')
@section('meta_description', 'Guía oficial y completa de prefijos telefónicos y códigos de área de Chile según SUBTEL. Consultá de qué ciudad o región te llaman y cómo marcar.')

@section('styles')
<style>
    .area-hero {
        text-align: center;
        max-width: 850px;
        margin: 1.5rem auto 2.5rem;
    }

    .area-hero h1 {
        font-size: 2.3rem;
        font-weight: 900;
        letter-spacing: -0.6px;
        color: var(--text-main);
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .area-hero p {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Interactive Filter Box */
    .filter-wrapper {
        max-width: 550px;
        margin: 1.5rem auto 2.5rem;
        position: relative;
    }

    .filter-input {
        width: 100%;
        padding: 0.85rem 1.25rem 0.85rem 2.75rem;
        border: 2px solid var(--primary);
        border-radius: 9999px;
        font-size: 1rem;
        font-weight: 600;
        outline: none;
        box-shadow: 0 4px 14px rgba(0, 51, 160, 0.15);
        background: white;
    }

    .filter-icon {
        position: absolute;
        left: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
        color: var(--primary);
    }

    /* Popular Codes Grid */
    .top-codes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .code-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
        box-shadow: var(--shadow-sm);
    }

    .code-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
        border-color: var(--primary);
    }

    .code-digit-badge {
        background: rgba(0, 51, 160, 0.08);
        color: var(--primary);
        font-size: 1.25rem;
        font-weight: 900;
        padding: 0.5rem 0.85rem;
        border-radius: 10px;
        font-variant-numeric: tabular-nums;
        border: 1px solid rgba(0, 51, 160, 0.15);
    }

    .code-info-text strong {
        display: block;
        font-size: 0.95rem;
        color: var(--text-main);
        margin-bottom: 0.2rem;
    }

    .code-info-text span {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Grouped By Region Block */
    .region-block {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        margin-bottom: 1.75rem;
        box-shadow: var(--shadow-sm);
    }

    .region-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border);
    }

    .sub-codes-flex {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 0.75rem;
    }

    .sub-code-item {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.65rem 0.85rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        transition: all 0.15s;
    }

    .sub-code-item:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .sub-code-digit {
        font-weight: 800;
        font-size: 0.9rem;
        color: var(--primary);
        font-variant-numeric: tabular-nums;
    }

    .sub-code-city {
        font-size: 0.82rem;
        color: var(--text-muted);
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<div class="content-tool">
    <!-- Breadcrumb -->
    <nav style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.25rem">
        <a href="{{ route('home') }}" style="color:var(--primary); text-decoration:none; font-weight:700">Inicio</a>
        <span style="margin:0 0.4rem">›</span>
        <span>Prefijos Telefónicos de Chile</span>
    </nav>

    <!-- Hero -->
    <div class="area-hero">
        <span style="display:inline-block; background:rgba(0, 51, 160, 0.1); color:var(--primary); font-weight:800; font-size:0.82rem; padding:4px 12px; border-radius:9999px; margin-bottom:0.75rem">
            🇨🇱 Catálogo Oficial SUBTEL Chile · Plan Nacional de Numeración
        </span>
        <h1>Directorio de Prefijos y Códigos de Área de Chile</h1>
        <p>
            Guía unificada de códigos de área para telefonía fija y móvil según la <strong>Subsecretaría de Telecomunicaciones (SUBTEL)</strong>. Consultá a qué región o ciudad corresponde cada prefijo y descubrí números reportados.
        </p>

        <!-- Filtro Interactivo en Tiempo Real -->
        <div class="filter-wrapper">
            <span class="filter-icon">🔍</span>
            <input type="text" id="filterInput" class="filter-input" placeholder="Filtrar por código o ciudad (ej: 2, 32, Santiago, Valparaíso...)" autocomplete="off">
        </div>
    </div>

    <!-- Principales Códigos de Área -->
    <h2 style="font-size:1.35rem; font-weight:800; color:var(--text-main); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem">
        <span>⭐</span> Principales Prefijos de Chile por Volumen
    </h2>

    <div class="top-codes-grid">
        @foreach($topCodes as $code => $info)
            <a href="{{ route('area-codes.show', $code) }}" class="code-card">
                <div class="code-digit-badge">{{ $code }}</div>
                <div class="code-info-text">
                    <strong>{{ $info['city'] }}</strong>
                    <span>{{ $info['region'] }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Directorio Completo por Región -->
    <h2 style="font-size:1.35rem; font-weight:800; color:var(--text-main); margin-bottom:1.25rem; display:flex; align-items:center; gap:0.5rem">
        <span>📍</span> Directorio de Códigos de Área por Región
    </h2>

    <section id="directorySections">
        @foreach($grouped as $region => $codes)
            <div class="region-block" data-region="{{ Str::lower($region) }}">
                <div class="region-title">
                    <span>🇨🇱</span>
                    <span>{{ $region }}</span>
                    <span style="font-size:0.8rem; font-weight:600; color:var(--text-muted); margin-left:auto">
                        {{ count($codes) }} prefijos
                    </span>
                </div>

                <div class="sub-codes-flex">
                    @foreach($codes as $c => $d)
                        <a href="{{ route('area-codes.show', $c) }}" class="sub-code-item" data-code="{{ $c }}" data-city="{{ Str::lower($d['city']) }}" data-reg="{{ Str::lower($region) }}">
                            <span class="sub-code-digit">+56 {{ $c }}</span>
                            <span class="sub-code-city" title="{{ $d['city'] }}">{{ $d['city'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <!-- Guía de Marcación Oficial SUBTEL -->
    <div class="region-block" style="background: linear-gradient(135deg, #0033a0, #001f66); color:white; border:none; margin-top:3rem">
        <h3 style="color:white; font-size:1.35rem; font-weight:800; margin-bottom:1rem">
            📞 ¿Cómo funciona la numeración telefónica en Chile (SUBTEL)?
        </h3>
        <p style="color:#e0f2fe; font-size:0.92rem; line-height:1.6; margin-bottom:1.25rem">
            En Chile rige el <strong>Plan Nacional de Numeración Unificada de la SUBTEL</strong>, donde todos los números nacionales constan exactamente de <strong>9 dígitos</strong>:
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:1rem">
            <div style="background:rgba(255, 255, 255, 0.08); border-radius:10px; padding:1rem">
                <strong style="color:white; display:block; margin-bottom:0.3rem">📱 Celulares / Móviles (9)</strong>
                <span style="color:#bae6fd; font-size:0.85rem">Todos los móviles inician con 9 seguido de 8 dígitos (ej: +56 9 8765 4321).</span>
            </div>
            <div style="background:rgba(255, 255, 255, 0.08); border-radius:10px; padding:1rem">
                <strong style="color:white; display:block; margin-bottom:0.3rem">☎️ Telefonía Fija Regional</strong>
                <span style="color:#bae6fd; font-size:0.85rem">Santiago usa el 2 (2 2XXX XXXX) y las regiones tienen códigos de 2 dígitos (ej: 32 Valparaíso, 41 Concepción).</span>
            </div>
            <div style="background:rgba(255, 255, 255, 0.08); border-radius:10px; padding:1rem">
                <strong style="color:white; display:block; margin-bottom:0.3rem">🌐 VoIP y Servicios (44 / 809)</strong>
                <span style="color:#bae6fd; font-size:0.85rem">Prefijo 44 para telefonía IP nacional y 809 para llamadas masivas comerciales reguladas por SUBTEL.</span>
            </div>
        </div>
    </div>

    <!-- EEAT Author Card (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Compilado y estructurado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador del directorio QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección comunitaria frente a fraudes y spam telefónico en Chile, España y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="{{ route('legal.about') }}">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('filterInput');
    const items = document.querySelectorAll('.sub-code-item');
    const blocks = document.querySelectorAll('.region-block[data-region]');

    input.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();

        if (!query) {
            items.forEach(el => el.style.display = 'flex');
            blocks.forEach(b => b.style.display = 'block');
            return;
        }

        blocks.forEach(block => {
            let visibleInBlock = 0;
            const blockItems = block.querySelectorAll('.sub-code-item');
            blockItems.forEach(item => {
                const code = item.dataset.code;
                const city = item.dataset.city;
                const reg = item.dataset.reg;

                if (code.includes(query) || city.includes(query) || reg.includes(query)) {
                    item.style.display = 'flex';
                    visibleInBlock++;
                } else {
                    item.style.display = 'none';
                }
            });

            block.style.display = visibleInBlock > 0 ? 'block' : 'none';
        });
    });
});
</script>

<!-- Schema.org BreadcrumbList -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@@type": "ListItem",
      "position": 1,
      "name": "Inicio",
      "item": "{{ url('/') }}"
    },
    {
      "@@type": "ListItem",
      "position": 2,
      "name": "Prefijos Telefónicos de Chile",
      "item": "{{ url('/prefijos') }}"
    }
  ]
}
</script>
@endsection
