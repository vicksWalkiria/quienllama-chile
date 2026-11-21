@extends('layouts.app')

@php
    $repTotal = $comments->total();
    $seoTitle = $repTotal > 0
        ? "{$phone->number} ({$formatted}): ¿Quién me llama? ({$repTotal} rep.)"
        : "¿Quién me llama del {$phone->number} ({$formatted})? Spam CL";
    $seoLoc = trim(preg_replace('/\s*\(.*$/', '', $phone->location ?: 'Chile'));
    $seoLoc = \Illuminate\Support\Str::words($seoLoc, 5, '');
    $seoDesc = "¿Quién llama del {$phone->number} ({$formatted} · {$seoLoc})? "
        . ($repTotal > 0 ? "{$repTotal} " . ($repTotal === 1 ? 'denuncia' : 'denuncias') . " (riesgo {$risk['level']}). " : '')
        . "Descubre si es spam, cobranza o estafa.";
@endphp
@section('title', $seoTitle)
@section('meta_description', $seoDesc)
@section('og_image', route('phone.image', $phone->number))
@section('og_image_alt', '¿Quién me llama del ' . $phone->number . ' (' . $formatted . ')? Nivel de riesgo y denuncias en Chile')

@section('styles')
<style>
    .phone-detail {
        max-width: var(--content-width);
        margin: 0 auto;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 1.25rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* Phone Header (Estilo QuiénLlama) */
    .phone-header {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .phone-header h1 {
        font-size: 2.2rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .phone-header h1 span {
        color: var(--primary);
    }

    .spam-meter-pills {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .meter-pill {
        background: var(--background);
        border: 1px solid var(--border);
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-main);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .meter-pill.danger {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #b91c1c;
    }

    .action-btn-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-copy {
        background: #e2e8f0;
        color: var(--text-main);
    }
    .btn-copy:hover {
        background: #cbd5e1;
    }

    .btn-vcf {
        background: #1e293b;
        color: white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .btn-vcf:hover {
        background: #0f172a;
    }

    .btn-nollame {
        background: var(--primary);
        color: white;
        box-shadow: 0 2px 6px rgba(0, 51, 160, 0.2);
    }
    .btn-nollame:hover {
        background: var(--primary-hover);
    }

    .btn-incogni-top {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        color: white;
        box-shadow: 0 2px 6px rgba(13, 148, 136, 0.3);
    }
    .btn-incogni-top:hover {
        background: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
        color: white;
        transform: translateY(-1px);
    }

    .btn-wa {
        background: #25d366;
        color: white;
    }
    .btn-wa:hover {
        background: #1eb954;
    }

    /* Social Share Box */
    .share-alert-box {
        margin-top: 1.25rem;
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        text-align: left;
    }
    .share-alert-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .share-alert-header strong {
        font-size: 0.95rem;
        color: #92400e;
        display: block;
    }
    .share-alert-header span {
        font-size: 0.84rem;
        color: #b45309;
        display: block;
    }
    .share-alert-buttons {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 1.1rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .btn-share:hover {
        transform: translateY(-1px);
    }
    .btn-share-wa {
        background: #25d366;
        box-shadow: 0 2px 6px rgba(37, 211, 102, 0.3);
    }
    .btn-share-wa:hover {
        background: #1ebd58;
    }
    .btn-share-tg {
        background: #0088cc;
        box-shadow: 0 2px 6px rgba(0, 136, 204, 0.3);
    }
    .btn-share-tg:hover {
        background: #0077b5;
    }
    .btn-share-x {
        background: #0f172a;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.25);
    }
    .btn-share-x:hover {
        background: #1e293b;
    }
    .btn-share-copy {
        background: #ffffff;
        color: #92400e;
        border: 1.5px solid #d97706;
        box-shadow: 0 2px 5px rgba(217, 119, 6, 0.15);
    }
    .btn-share-copy:hover {
        background: #fef3c7;
    }

    /* Content Cards */
    .card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    @media (max-width: 640px) {
        .phone-header {
            padding: 1.25rem 1rem;
            text-align: center;
        }
        .phone-header h1 {
            font-size: 1.6rem;
            line-height: 1.25;
            word-break: break-word;
        }
        .spam-meter-pills {
            justify-content: center;
            gap: 6px;
        }
        .meter-pill {
            font-size: 0.8rem;
            padding: 4px 10px;
        }
        .action-btn-row {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        .action-btn-row .btn-action {
            width: 100% !important;
            box-sizing: border-box !important;
            justify-content: center !important;
            text-align: center !important;
            font-size: 0.82rem !important;
            padding: 9px 8px !important;
            white-space: normal !important;
            line-height: 1.25 !important;
            border-radius: 10px !important;
        }
        .card {
            padding: 1.25rem 1rem;
        }
        .card-title {
            font-size: 1.15rem;
        }
        .vote-options {
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        .dial-table td {
            font-size: 0.82rem;
            padding: 0.6rem 0.25rem;
        }
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Voting options */
    .vote-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0.65rem;
        margin-top: 1rem;
    }

    .vote-btn {
        background: var(--background);
        border: 1.5px solid var(--border);
        padding: 0.75rem 0.5rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        color: var(--text-main);
        transition: all 0.2s;
        text-align: center;
    }

    .vote-btn:hover {
        background: #fee2e2;
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Dialing table */
    .dial-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dial-table tr {
        border-bottom: 1px solid var(--border);
    }

    .dial-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.92rem;
    }

    .dial-table td:last-child {
        text-align: right;
        font-family: monospace;
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-main);
    }

    /* Forms */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-main);
        margin-bottom: 0.4rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        background: var(--background);
        outline: none;
        transition: border 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        background: white;
        border-color: var(--primary);
    }

    /* Ficha Técnica y Resumen Directo (GEO / AEO) */
    .phone-direct-answer-card {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }
    .direct-answer-summary {
        font-size: 0.96rem;
        line-height: 1.65;
        color: var(--text-main);
        background: var(--background);
        border: 1px solid #cbd5e1;
        padding: 0.9rem 1.1rem;
        border-radius: 10px;
        margin: 0 0 1.25rem 0;
        font-variant-numeric: tabular-nums;
    }
    .phone-visual-card-fig {
        margin: 0 0 1.25rem 0;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        overflow: hidden;
        background: #f8fafc;
    }
    .phone-visual-card-fig img {
        display: block;
        width: 100%;
        height: auto;
        aspect-ratio: 1200 / 630;
    }
    .phone-visual-card-fig figcaption {
        padding: 0.55rem 0.9rem;
        font-size: 0.8rem;
        color: #475569;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        font-variant-numeric: tabular-nums;
    }
    .related-visual-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(215px, 1fr));
        gap: 12px;
        margin-bottom: 12px;
    }
    .related-visual-item {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none;
        background: #f8fafc;
        color: var(--text-main);
        transition: border-color 0.15s, transform 0.15s;
    }
    .related-visual-item:hover {
        border-color: var(--primary);
        transform: translateY(-1px);
    }
    .related-visual-item img {
        display: block;
        width: 100%;
        height: auto;
        aspect-ratio: 1200 / 630;
        border-bottom: 1px solid #e2e8f0;
    }
    .related-visual-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        padding: 8px 10px;
        font-size: 0.88rem;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }
    .related-text-pills {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(185px, 1fr));
        gap: 8px;
    }
    .related-text-pill {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        min-height: 44px;
        border: 1px solid var(--border);
        border-radius: 10px;
        text-decoration: none;
        background: #f8fafc;
        color: var(--text-main);
        font-size: 0.88rem;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }
    .related-text-pill:hover {
        border-color: var(--primary);
        color: var(--primary);
    }
    .phone-specs-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid var(--border);
        border-radius: 12px;
    }
    .phone-specs-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        background: #ffffff;
    }
    .phone-specs-table th {
        width: 38%;
        text-align: left;
        padding: 0.75rem 1rem;
        background: var(--background);
        color: var(--text-main);
        font-weight: 700;
        border-bottom: 1px solid var(--border);
        border-right: 1px solid var(--border);
        vertical-align: middle;
    }
    .phone-specs-table td {
        padding: 0.75rem 1rem;
        color: var(--text-main);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    .phone-specs-table tr:last-child th,
    .phone-specs-table tr:last-child td {
        border-bottom: none;
    }
    .subtel-reg-notice {
        border-radius: var(--radius);
        padding: 1.1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
    }
    .subtel-reg-notice.tone-danger {
        background: #fef2f2;
        border-color: #fecaca;
    }
    .subtel-reg-notice.tone-warning {
        background: #fffbeb;
        border-color: #fde68a;
    }
    .subtel-reg-notice.tone-info {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    .subtel-reg-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.1);
        color: var(--primary);
    }
    .subtel-reg-notice.tone-danger .subtel-reg-icon { color: #991b1b; }
    .subtel-reg-notice.tone-warning .subtel-reg-icon { color: #92400e; }
    .subtel-reg-body strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }
    .subtel-reg-body p {
        font-size: 0.88rem;
        line-height: 1.58;
        color: #334155;
        margin: 0;
    }
    .operator-pill-link {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: var(--primary);
        text-decoration: none;
        min-height: 38px;
        transition: background 0.15s, border-color 0.15s;
    }
    .operator-pill-link:hover {
        background: #dbeafe;
        border-color: var(--primary);
    }
    .th-svg-label {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }
    .spec-tabular {
        font-variant-numeric: tabular-nums;
    }
    @media (max-width: 640px) {
        .phone-specs-table th {
            width: 44%;
            padding: 0.65rem 0.75rem;
            font-size: 0.84rem;
        }
        .phone-specs-table td {
            padding: 0.65rem 0.75rem;
            font-size: 0.84rem;
        }
    }
</style>
@endsection

@section('content')
<div class="phone-detail">
    <a href="{{ route('home') }}" class="back-link">&larr; Volver al buscador</a>

    <!-- Phone Header (Estilo QuiénLlama) -->
    <div class="phone-header">
        <h1>¿De quién es el <span>{{ $formatted }}</span>?</h1>

        <div class="spam-meter-pills">
            <span class="meter-pill {{ ($phone->spam_score > 0 || $comments->total() > 0) ? 'danger' : '' }}">
                🚨 <strong id="spamScoreVal">{{ $phone->spam_score > 0 ? $phone->spam_score : $comments->total() }}</strong> reportes comunitarios
            </span>

            <a href="{{ route('area-codes.show', $phone->area_code ?: '2') }}" class="meter-pill" style="text-decoration:none">
                📍 {{ $phone->location ?: 'Chile' }} (Prefijo {{ $phone->area_code }})
            </a>

            @if(!empty($telecomBlock))
                <a href="{{ route('operators.show', $telecomBlock['operator_slug']) }}" class="meter-pill operator-pill-link" title="Ver bloques oficiales SUBTEL de {{ $telecomBlock['operator_name'] }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span>SUBTEL: {{ $telecomBlock['operator_name'] }}</span>
                </a>
            @endif

            <span class="meter-pill">
                📞 {{ $dialing['type'] ?? 'Línea de Telecomunicaciones SUBTEL' }}
            </span>

            <a href="{{ route('legal.borrar-datos') }}" class="meter-pill" style="text-decoration:none; background:#f0fdf4; color:#166534; border: 1px solid #86efac; font-weight:700;" title="Guía: ¿Cómo hacer que borren mis datos personales de las listas de llamadas?">
                🛡️ ¿Cómo hacer que borren mis datos?
            </a>

            <span class="meter-pill">
                👁️ {{ $phone->views }} consultas
            </span>
        </div>

        <!-- Botones de Acción Rápida -->
        <div class="action-btn-row">
            <button type="button" class="btn-action btn-copy" onclick="copyNumber('{{ $phone->number }}')">
                📋 Copiar Número
            </button>

            <a href="{{ route('phone.vcf', $phone->number) }}" class="btn-action btn-vcf">
                🚫 Descargar VCF
            </a>

            <a href="{{ route('legal.no-molestar') }}" class="btn-action btn-nollame">
                ⚖️ SERNAC «No Molestar»
            </a>

            <a href="{{ route('legal.borrar-datos') }}" class="btn-action" style="background:#f0fdf4; color:#14532d; border: 1.5px solid #86efac; text-decoration:none;" title="Guía: ¿Cómo hacer que borren mis datos?">
                ❓ ¿Cómo borrar mis datos?
            </a>

            <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_cl_topbtn" 
               target="_blank" rel="noopener nofollow sponsored" 
               class="btn-action btn-incogni-top"
               onclick="if(typeof trackGoal==='function'){trackGoal('incogni_click','phone_top_button');} if(typeof gtag==='function'){gtag('event','click_incogni_affiliate',{'source':'phone_top_button'});}"
               title="Eliminar mis datos de bases de prospección con Incogni">
                🛡️ Borrar mis datos (Incogni)
            </a>
        </div>

        <!-- Alerta para Compartir por Redes Sociales -->
        <div class="share-alert-box">
            <div class="share-alert-header">
                <span style="font-size: 1.6rem; line-height: 1;">📢</span>
                <div>
                    <strong>¡Advierte a tus contactos sobre este número!</strong>
                    <span>Si te llamaron, comparte esta alerta para prevenir estafas telefónicas en Chile.</span>
                </div>
            </div>
            <div class="share-alert-buttons">
                <a href="https://api.whatsapp.com/send?text={{ urlencode('¡Ojo! Si te llaman de este número no contestes: ' . $formatted . '. Revisa más antecedentes y denuncias en ' . url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-wa" 
                   onclick="trackSocialShare('whatsapp', '{{ $phone->number }}')">
                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.541 1.948.825 2.796.825 3.183 0 5.768-2.586 5.769-5.766.001-3.182-2.585-5.768-5.769-5.768zm0-2.172c4.378 0 7.938 3.559 7.938 7.938 0 4.378-3.56 7.938-7.938 7.938-1.282 0-2.522-.315-3.626-.893l-4.405 1.155 1.176-4.298c-.672-1.168-1.083-2.482-1.083-3.902 0-4.379 3.56-7.938 7.938-7.938z"/></svg>
                    WhatsApp
                </a>

                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode('¡Ojo! Si te llaman de este número no contestes: ' . $formatted . '. Revisa más antecedentes y denuncias:') }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-tg" 
                   onclick="trackSocialShare('telegram', '{{ $phone->number }}')">
                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                    Telegram
                </a>

                <a href="https://twitter.com/intent/tweet?text={{ urlencode('¡Ojo! Si te llaman de este número no contestes: ' . $formatted . '. Revisa más antecedentes y denuncias en ' . url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-x" 
                   onclick="trackSocialShare('x_twitter', '{{ $phone->number }}')">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    Compartir en 𝕏
                </a>

                <button type="button" class="btn-share btn-share-copy" id="btnCopyAlert" onclick="shareAlertNative('{{ $phone->number }}', '{{ $formatted }}', '{{ url()->current() }}', '¡Ojo! Si te llaman de este número no contestes: {{ $formatted }}. Revisa más antecedentes y denuncias en {{ url()->current() }}')">
                    <span>🔗</span> Compartir Alerta
                </button>
            </div>
        </div>
    </div>

    <!-- Anuncio AdSense Chile - Superior Ficha -->
    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    @if($comments->total() > 0)
    <!-- Testimonios reales arriba para retención inmediata -->
    <div class="card" id="comentarios-usuarios">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.5rem; margin-bottom:0.75rem">
            <h2 class="card-title" style="margin:0">💬 Denuncias y Comentarios de Usuarios ({{ $comments->total() }})</h2>
            <a href="#formulario-reporte" style="font-size:0.85rem; font-weight:700; color:var(--primary); text-decoration:none;">+ Dejar mi reporte ↓</a>
        </div>

        @foreach($comments as $comment)
            <div style="border-bottom:1px solid var(--border); padding:1rem 0">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.4rem">
                    <strong style="color:var(--text-main); font-size:0.95rem">👤 {{ $comment->author_name }}</strong>
                    <span style="background:#fee2e2; color:#991b1b; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:6px">
                        {{ $comment->reason }}
                    </span>
                </div>
                <p style="font-size:0.92rem; color:#334155; line-height:1.6; margin-bottom:0.4rem">
                    {{ $comment->content }}
                </p>
                <span style="font-size:0.78rem; color:var(--text-muted)">
                    📅 {{ $comment->created_at->translatedFormat('d \d\e F \d\e Y, H:i') }}
                </span>
            </div>
        @endforeach

        <div style="margin-top:1.25rem">
            {{ $comments->links() }}
        </div>
    </div>
    @endif

    <!-- Ficha Técnica y Resumen Directo (Optimizado para GEO / AEO / LLMs y Usuarios) -->
    <section class="card phone-direct-answer-card" id="fichaTecnica">
        <h2 class="card-title" style="margin-bottom: 0.85rem;">📋 Ficha Técnica y Resumen del {{ $formatted }}</h2>

        @if(!empty($regulatoryNotice))
            <div class="subtel-reg-notice tone-{{ $regulatoryNotice['tone'] ?? 'info' }}" role="note" aria-label="Aviso normativo SUBTEL">
                <div class="subtel-reg-icon" aria-hidden="true">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                </div>
                <div class="subtel-reg-body">
                    <strong>{{ $regulatoryNotice['title'] }}</strong>
                    <p>
                        {{ $regulatoryNotice['text'] }}
                        @if(!empty($telecomBlock))
                            Concesionaria asignataria en SUBTEL: <a href="{{ route('operators.show', $telecomBlock['operator_slug']) }}" style="color:var(--primary); font-weight:700;">{{ $telecomBlock['operator_name'] }}</a>.
                        @endif
                    </p>
                </div>
            </div>
        @endif

        <p class="direct-answer-summary">
            <strong>¿De quién es el teléfono {{ $formatted }}?</strong> 
            El número <strong>{{ $formatted }}</strong> (formato internacional {{ $dialing['international'] }}) corresponde a una línea de <strong>{{ mb_strtolower($dialing['type'] ?? 'telecomunicaciones SUBTEL', 'UTF-8') }}</strong> con prefijo <strong>{{ $phone->area_code }}</strong> ({{ $phone->location ?: 'Chile' }}).
            @if(!empty($telecomBlock))
                Según el Plan Técnico Fundamental de Numeración de <strong>SUBTEL</strong>, pertenece al bloque oficial <strong>{{ $telecomBlock['range_formatted'] }}</strong> asignado a la concesionaria <a href="{{ route('operators.show', $telecomBlock['operator_slug']) }}" style="color:var(--primary); font-weight:700;">{{ $telecomBlock['operator_name'] }}</a> ({{ $telecomBlock['legal_name'] }}){{ $telecomBlock['is_voip_or_masivo'] ? ', operador con infraestructura VoIP o de tráfico masivo' : ', sujeto a portabilidad numérica (Ley N° 20.471)' }}.
            @endif
            @if($phone->spam_score > 0 || $comments->total() > 0)
                Registra <strong>{{ $comments->total() }} {{ $comments->total() === 1 ? 'denuncia comunitaria' : 'denuncias comunitarias' }}</strong> con un nivel de riesgo clasificado como <strong>{{ $risk['level'] }}</strong> ({{ $risk['badge'] }}).
                {{ $risk['level'] === 'Peligroso' || $risk['level'] === 'Sospechoso' ? 'Se recomienda precaución, no entregar datos personales ni bancarios bajo sospecha de estafa o cobranza abusiva, y bloquear las llamadas de esta numeración.' : 'No se aprecian incidencias graves de fraude o estafas en los reportes.' }}
            @else
                Actualmente no cuenta con denuncias de fraude ni reportes de spam telefónico registrados en nuestra base comunitaria en Chile.
            @endif
        </p>

        <figure class="phone-visual-card-fig">
            <img src="{{ route('phone.image', $phone->number) }}"
                 alt="¿Quién me llama del {{ $phone->number }} ({{ $formatted }})? Nivel de riesgo y denuncias en Chile"
                 width="1200" height="630" loading="eager" decoding="async">
            <figcaption>
                Ficha gráfica de identificación y riesgo comunitario para <strong>{{ $formatted }}</strong> ({{ $dialing['international'] }}) · {{ $phone->location ?: 'Chile' }}{{ !empty($telecomBlock) ? ' · ' . $telecomBlock['operator_name'] : '' }}.
            </figcaption>
        </figure>

        <div class="phone-specs-table-wrap">
            <table class="phone-specs-table">
                <tbody>
                    <tr>
                        <th scope="row">📞 Número de teléfono</th>
                        <td class="spec-tabular"><strong>{{ $formatted }}</strong> ({{ $phone->number }} · {{ strlen($phone->number) }} dígitos)</td>
                    </tr>
                    <tr>
                        <th scope="row">🌐 Marcación internacional</th>
                        <td class="spec-tabular">{{ $dialing['international'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">📍 Región / Prefijo SUBTEL</th>
                        <td><a href="{{ route('area-codes.show', $phone->area_code ?: '2') }}" style="color:var(--primary); font-weight:700; text-decoration:none;">{{ $phone->location ?: 'Chile' }} (Prefijo {{ $phone->area_code }})</a></td>
                    </tr>
                    <tr>
                        <th scope="row">📶 Tipo de línea</th>
                        <td>{{ $telecomBlock['service_type'] ?? ($dialing['type'] ?? 'Telefonía SUBTEL') }}</td>
                    </tr>
                    @if(!empty($telecomBlock))
                    <tr>
                        <th scope="row">
                            <span class="th-svg-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                Operador Concesionario SUBTEL
                            </span>
                        </th>
                        <td>
                            <a href="{{ route('operators.show', $telecomBlock['operator_slug']) }}" style="color:var(--primary); font-weight:800; text-decoration:none;">{{ $telecomBlock['operator_name'] }}</a>
                            <span style="display:block; font-size:0.8rem; color:var(--text-muted); margin-top:2px;">
                                {{ $telecomBlock['legal_name'] }} · {{ $telecomBlock['is_voip_or_masivo'] ? 'Red VoIP / subasignación corporativa o call center' : 'Concesionaria de origen (sujeta a portabilidad numérica Ley 20.471)' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="th-svg-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                Bloque Oficial SUBTEL
                            </span>
                        </th>
                        <td class="spec-tabular">
                            <strong>{{ $telecomBlock['range_formatted'] }}</strong>
                            <span style="font-size:0.8rem; color:var(--text-muted); margin-left:4px;">({{ number_format($telecomBlock['capacity'], 0, ',', '.') }} números{{ $telecomBlock['regulator_meta'] ? ' · ' . $telecomBlock['regulator_meta'] : '' }})</span>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row">🚨 Nivel de riesgo</th>
                        <td>
                            <span style="background: {{ $risk['bg'] }}; color: {{ $risk['text_color'] }}; border: 1.5px solid {{ $risk['color'] }}; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 0.85rem; display: inline-block;">
                                {{ $risk['icon'] }} {{ $risk['badge'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">💬 Reportes registrados</th>
                        <td>{{ $comments->total() }} {{ $comments->total() === 1 ? 'denuncia' : 'denuncias' }} de usuarios</td>
                    </tr>
                    <tr>
                        <th scope="row">⚖️ Protección oficial</th>
                        <td>Bloqueo con tarjeta VCF / Portal SERNAC «No Molestar» (Ley del Consumidor)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Anuncio AdSense Chile - Ficha de Teléfono -->
    @include('partials.ad_slot', ['margin' => '1.75rem auto'])

    <!-- Quick Poll Voting Card -->
    <div class="card" style="border: 2px solid var(--primary); background:#ffffff;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:0.5rem">
            <span style="font-size:1.4rem">🗳️</span>
            <h2 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin:0">
                ¿Te llamaron desde este número? Vota en 1 clic:
            </h2>
        </div>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:0.75rem">
            Tu voto ayuda al instante a categorizar si este número es spam, venta telefónica o una posible estafa en Chile.
        </p>

        <form action="{{ route('phone.vote', $phone->number) }}" method="POST">
            @csrf
            <div class="vote-options">
                <button type="submit" name="reason" value="Estafa / Phishing" class="vote-btn">🚨 Estafa / Phishing</button>
                <button type="submit" name="reason" value="Telemarketing" class="vote-btn">📢 Telemarketing</button>
                <button type="submit" name="reason" value="Llamada Silenciosa" class="vote-btn">🔇 Llamada Muda</button>
                <button type="submit" name="reason" value="Cobro de Deudas" class="vote-btn">💳 Cobro de Deuda</button>
            </div>
        </form>
    </div>

    <!-- ====== BLOQUE NATIVO RECOMENDADO: INCOGNI (ELIMINACIÓN DE DATOS Y TELEMARKETING CHILE) ====== -->
    <section class="card incogni-promo-box" style="margin-top: 1.5rem; background: linear-gradient(135deg, #0b1528 0%, #162544 100%); border: 1.5px solid #2e446d; border-radius: 18px; padding: 1.75rem; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(11, 21, 40, 0.35); position: relative; overflow: hidden;">
        <!-- Elemento decorativo de fondo -->
        <div style="position: absolute; top: -40px; right: -40px; width: 140px; height: 140px; background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, rgba(0,0,0,0) 70%); border-radius: 50%; pointer-events: none;"></div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 1rem;">
            <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; color: #34d399;">
                <span>🛡️ Solución Definitiva &bull; Protección Legal de Datos</span>
            </div>
            <div style="font-size: 0.8rem; color: #94a3b8; font-weight: 600;">
                Desarrollado por <strong style="color: #cbd5e1;">Surfshark</strong> &bull; ⭐ 4.5/5 en Trustpilot
            </div>
        </div>

        <h2 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; margin: 0 0 0.6rem 0; line-height: 1.35;">
            ¿Cansado de llamadas comerciales y cobranzas? Elimina tu teléfono de raíz
        </h2>

        <p style="color: #cbd5e1; font-size: 0.94rem; line-height: 1.6; margin-bottom: 1.25rem;">
            Bloquear números en tu celular ayuda, pero las empresas de telecomunicaciones, retail y cobranza compran continuamente tus datos a <strong>Data Brokers internacionales</strong>. Con <strong>Incogni</strong>, obligas legalmente a más de 180 empresas intermediarias a <u>eliminar de forma permanente tu número celular, nombre y correo</u> de sus bases de prospección.
        </p>

        <!-- Puntos clave con checks -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 0.75rem; margin-bottom: 1.4rem;">
            <div style="display: flex; align-items: flex-start; gap: 8px; font-size: 0.88rem; color: #e2e8f0;">
                <span style="color: #10b981; font-size: 1.1rem; line-height: 1; font-weight: 900;">✓</span>
                <div><strong>Reduce hasta un 90%</strong> las llamadas no deseadas y robocalls.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 8px; font-size: 0.88rem; color: #e2e8f0;">
                <span style="color: #10b981; font-size: 1.1rem; line-height: 1; font-weight: 900;">✓</span>
                <div><strong>100% Automatizado:</strong> Reclamaciones legales sin trámites burocráticos.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 8px; font-size: 0.88rem; color: #e2e8f0;">
                <span style="color: #10b981; font-size: 1.1rem; line-height: 1; font-weight: 900;">✓</span>
                <div><strong>Complemento al SERNAC:</strong> Borrado continuo ante nuevos brokers.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 8px; font-size: 0.88rem; color: #e2e8f0;">
                <span style="color: #10b981; font-size: 1.1rem; line-height: 1; font-weight: 900;">✓</span>
                <div><strong>Garantía de reembolso de 30 días</strong> sin compromiso.</div>
            </div>
        </div>

        <!-- Barra CTA -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.25rem;">
            <div style="font-size: 0.84rem; color: #94a3b8;">
                <span style="color: #fbbf24; font-weight: 700;">🎁 Promoción exclusiva para la comunidad QuiénLlama Chile</span>
            </div>
            <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_cl_card" 
               target="_blank" rel="noopener nofollow sponsored" 
               class="btn-incogni-cta"
               onclick="if(typeof trackGoal==='function'){trackGoal('incogni_click','phone_main_card');} if(typeof gtag==='function'){gtag('event','click_incogni_affiliate',{'source':'phone_main_card'});}"
               style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 800; font-size: 0.98rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); transition: transform 0.2s, box-shadow 0.2s;">
                <span>Borrar mis datos de telemarketing con Incogni</span>
                <span style="font-size: 1.1rem;">➔</span>
            </a>
        </div>
    </section>

    <!-- Community Telegram Banner CTA -->
    <div class="telegram-banner-cta">
        <div class="telegram-banner-content">
            <div class="telegram-banner-icon">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="#ffffff"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
            </div>
            <div class="telegram-banner-text">
                <p class="telegram-banner-title" style="font-size: 1.15rem; font-weight: 800; color: #ffffff; margin: 0 0 0.25rem;">💬 ¿Cansado de llamadas molestas y estafas?</p>
                <p>Súmate a la comunidad oficial de <strong>QuiénLlama Chile 🇨🇱</strong> en Telegram. Recibe alertas al instante sobre números sospechosos y telemarketing en el país.</p>
            </div>
        </div>
        <a href="https://t.me/+C91vWOozJvI4NzJk" target="_blank" rel="noopener noreferrer" class="telegram-banner-btn" onclick="if(typeof trackGoal==='function'){trackGoal('join_telegram_community', {event_label:'phone_show_banner'});}">
            <span>Unirme al Grupo ➔</span>
        </a>
    </div>

    @if($comments->total() === 0)
    <!-- Comments / Reports Section (Empty state) -->
    <div class="card">
        <h2 class="card-title">💬 Denuncias y Comentarios de Usuarios (0)</h2>
        <p style="color:var(--text-muted); padding:0.5rem 0">
            Todavía no hay comentarios para este número. Sé el primero en compartir tu experiencia abajo.
        </p>
    </div>
    @endif

    <!-- Formulario de denuncia -->
    <div class="card" id="formulario-reporte">
        <h2 class="card-title">📝 Dejar un Reporte sobre el {{ $formatted }}</h2>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1.25rem">
            ¿Qué te dijeron cuando contestaste? ¿De qué empresa afirmaban ser? Tu testimonio protege a otros usuarios en Chile.
        </p>

        <form action="{{ route('phone.comment', $phone->number) }}" method="POST">
            @csrf
            <div style="display:none !important;" aria-hidden="true">
                <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="author_name">Tu Nombre o Alias (Opcional):</label>
                <input type="text" id="author_name" name="author_name" placeholder="Ej: Usuario de Santiago, Vecino de Concepción...">
            </div>

            <div class="form-group">
                <label for="reason">Motivo del Reporte (*):</label>
                <select id="reason" name="reason" required>
                    <option value="Estafa / Phishing">🚨 Intento de Estafa / Robo de Datos / Phishing</option>
                    <option value="Telemarketing">📢 Telemarketing / Promoción de Telefonía o Seguros</option>
                    <option value="Llamada Silenciosa">🔇 Llamada Silenciosa / Robocall (Cortan al contestar)</option>
                    <option value="Cobro de Deudas">💳 Cobro de Deudas / Empresa de Cobranza</option>
                    <option value="Otro">ℹ️ Otro Motivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Detalle de la llamada (*):</label>
                <textarea id="content" name="content" rows="4" required minlength="6" placeholder="Cuenta qué pasó cuando te llamaron..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%">
                📢 Publicar Reporte
            </button>
        </form>
    </div>

    <!-- Formas de marcación -->
    <div class="card">
        <h3 class="card-title">📞 Formas de Marcación Oficiales (SUBTEL Chile)</h3>
        <table class="dial-table">
            <tr>
                <td>Marcación Nacional Directa</td>
                <td>{{ $formatted }} ({{ strlen($phone->number) }} dígitos)</td>
            </tr>
            <tr>
                <td>Desde Celular o Red Móvil</td>
                <td>{{ $formatted }}</td>
            </tr>
            <tr>
                <td>Marcación Internacional / WhatsApp</td>
                <td>+56 {{ $phone->number }}</td>
            </tr>
            <tr>
                <td>Tipo de Red / Cobertura</td>
                <td>{{ $telecomBlock ? $telecomBlock['operator_name'] . ' · ' . $telecomBlock['service_type'] : ($dialing['type'] ?? 'Chile') }}</td>
            </tr>
        </table>
    </div>

    @if(isset($relatedPhones) && $relatedPhones->count() > 0)
    <div class="card">
        <h2 class="card-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4h3l1.5 4-2 1.5a11 11 0 0 0 5 5L14 12.5l4 1.5v3a2 2 0 0 1-2 2A15 15 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
            Otros números sospechosos {{ $relatedPhones->contains('is_same_series', true) ? 'de la misma serie (' . (strlen($phone->number) === 10 ? substr($phone->number, 0, 7) : substr($phone->number, 0, 6)) . 'XXX)' : 'con prefijo ' . $phone->area_code . ' (' . ($phone->location ?: 'Chile') . ')' }}
        </h2>
        <div class="related-visual-grid">
            @foreach($relatedPhones->take(4) as $rp)
                <a href="{{ route('phone.show', $rp->number) }}" class="related-visual-item" title="¿Quién me llama del {{ $rp->number }}? Denuncias y spam en Chile">
                    <img src="{{ route('phone.image', $rp->number) }}"
                         alt="¿Quién me llama del {{ $rp->number }}? Reportes y riesgo en Chile"
                         width="600" height="315" loading="lazy" decoding="async">
                    <div class="related-visual-meta">
                        <span>{{ $rp->formatted() }}</span>
                        @if(!empty($rp->is_same_series))
                            <span style="font-size:0.65rem; background:#fee2e2; color:#991b1b; padding:2px 6px; border-radius:6px; font-weight:800;">Misma serie</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        @if($relatedPhones->count() > 4)
        <div class="related-text-pills">
            @foreach($relatedPhones->slice(4) as $rp)
                <a href="{{ route('phone.show', $rp->number) }}" class="related-text-pill" title="Consultar número {{ $rp->number }} en Chile">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4h3l1.5 4-2 1.5a11 11 0 0 0 5 5L14 12.5l4 1.5v3a2 2 0 0 1-2 2A15 15 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
                    <span>{{ $rp->formatted() }}</span>
                    @if(!empty($rp->is_same_series))
                        <span style="font-size:0.65rem; background:#fee2e2; color:#991b1b; padding:2px 6px; border-radius:6px; font-weight:800; margin-left:auto;">Serie</span>
                    @endif
                </a>
            @endforeach
        </div>
        @endif
    </div>
    @endif

    <!-- FAQs Schema.org FAQPage -->
    <div class="card">
        <h3 class="card-title">❓ Preguntas Frecuentes</h3>
        
        <div style="margin-bottom:1.25rem">
            <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem">
                ¿De qué localidad es el número {{ $formatted }}?
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6">
                Corresponde a una línea con prefijo <strong>{{ $phone->area_code }}</strong> de <strong>{{ $phone->location ?: 'Chile' }}</strong>.
            </p>
        </div>

        <div style="margin-bottom:1.25rem">
            <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem">
                ¿Cómo puedo bloquear este número en mi celular?
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6">
                Puedes descargar directamente el contacto VCF con el botón superior o bloquearlo desde la aplicación de Teléfono de tu celular (Android o iPhone) en las opciones del número en el historial de llamadas recientes.
            </p>
        </div>

        <div>
            <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem">
                ¿Cómo evitar que sigan vendiendo mi número a empresas y agencias de cobranza?
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6">
                Además de inscribirte en la plataforma <a href="{{ route('legal.no-molestar') }}" style="color:var(--primary); font-weight:700;">«No Molestar» del SERNAC</a>, para evitar que tus datos sigan circulando entre intermediarios puedes utilizar <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_cl_faq" target="_blank" rel="noopener nofollow sponsored" style="color:var(--primary); font-weight:700; text-decoration:underline;">Incogni</a>, servicio avalado por Surfshark que exige el borrado legal continuo de tus datos a más de 180 Data Brokers.
            </p>
        </div>
    </div>

    <!-- EEAT Author Box (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Revisado y auditado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección comunitaria frente a fraudes y spam telefónico en Chile, España, México y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="{{ route('legal.about') }}">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyNumber(num) {
    navigator.clipboard.writeText(num).then(() => {
        alert('Número copiado al portapapeles: ' + num);
    });
}

function trackSocialShare(network, phone) {
    if (typeof window.trackGoal === 'function') {
        window.trackGoal('share_social', {
            network: network,
            phone_number: phone,
            event_label: network + '_' + phone
        });
    }
}

function shareAlertNative(phone, formatted, url, fullText) {
    trackSocialShare('native_or_copy', phone);
    if (navigator.share) {
        navigator.share({
            title: '¡Cuidado con el ' + formatted + '!',
            text: fullText,
            url: url
        }).catch(function() {});
    } else if (navigator.clipboard) {
        navigator.clipboard.writeText(fullText).then(function() {
            var btn = document.getElementById('btnCopyAlert');
            if (btn) {
                var orig = btn.innerHTML;
                btn.innerHTML = '✅ ¡Alerta copiada!';
                setTimeout(function() { btn.innerHTML = orig; }, 2500);
            }
        });
    }
}
</script>

<!-- Schema.org WebPage y FAQPage estructurados para GEO / AEO -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "{{ url()->current() }}#webpage",
      "name": "¿De quién es el teléfono {{ $phone->number }} ({{ $formatted }})?",
      "alternateName": ["{{ $phone->number }}", "{{ $formatted }}", "{{ $dialing['international'] }}"],
      "url": "{{ url()->current() }}",
      "description": "<?= addslashes(strip_tags('¿Quién te llama del ' . $phone->number . ' (' . $formatted . ' · ' . ($phone->location ?: 'Chile') . ')? Descubre si es spam, cobranza o estafa en Chile y cómo bloquearlo.')) ?>",
      "inLanguage": "es-CL",
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "@id": "{{ url()->current() }}#primaryimage",
        "url": "{{ route('phone.image', $phone->number) }}",
        "contentUrl": "{{ route('phone.image', $phone->number) }}",
        "width": 1200,
        "height": 630,
        "caption": "¿Quién me llama del {{ $phone->number }} ({{ $formatted }})? Nivel de riesgo y denuncias en Chile"
      },
      "image": "{{ route('phone.image', $phone->number) }}",
      "speakable": {
        "@type": "SpeakableSpecification",
        "cssSelector": [".direct-answer-summary", "h1"]
      }
    },
    {
      "@type": "FAQPage",
      "@id": "{{ url()->current() }}#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿De quién es el número {{ $formatted }}?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "El número {{ $formatted }} (internacional {{ $dialing['international'] }}) corresponde a una línea con prefijo {{ $phone->area_code }} de {{ $phone->location ?: 'Chile' }}. Cuenta con {{ $comments->total() }} denuncias registradas por la comunidad y un nivel de riesgo clasificado como {{ $risk['level'] }}."
          }
        },
        {
          "@type": "Question",
          "name": "¿Es peligroso contestar las llamadas del {{ $formatted }}?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ $risk['level'] === 'Peligroso' || $risk['level'] === 'Sospechoso' ? 'Sí, existen antecedentes de usuarios clasificándolo como cobranza extrajudicial, telemarketing no solicitado o intento de fraude telefónico. Se aconseja no entregar datos personales ni claves de tarjetas bancarias.' : 'Actualmente no cuenta con un alto volumen de denuncias de peligro en nuestra base comunitaria en Chile.' }}"
          }
        },
        {
          "@type": "Question",
          "name": "¿Cómo bloquear las llamadas de {{ $formatted }} en Chile?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Puedes bloquearlo desde las opciones del registro de llamadas en tu teléfono Android o iPhone, descargando la tarjeta VCF gratuita desde QuiénLlama Chile o solicitando el bloqueo en el portal «No Molestar» del SERNAC."
          }
        }
      ]
    }
  ]
}
</script>
@endsection
