@extends('layouts.app')

@section('title', 'Cómo Inscribirse en «No Molestar» del SERNAC - QuiénLlama Chile')
@section('meta_description', 'Guía completa sobre la plataforma No Molestar del SERNAC en Chile (Ley 19.496): cómo registrar tu celular o teléfono fijo con ClaveÚnica para bloquear llamadas y SMS spam.')

@section('content')
    <div class="content-tool">
        <div style="margin-bottom:2.5rem">
            <span style="display:inline-block; background:rgba(0, 51, 160, 0.1); color:var(--primary); font-weight:700; font-size:0.82rem; padding:4px 12px; border-radius:9999px; margin-bottom:0.75rem; border:1px solid rgba(0, 51, 160, 0.2)">
                ⚖️ Marco Regulatorio Oficial · República de Chile
            </span>
            <h1 style="font-size:2.3rem; font-weight:900; color:var(--text-main); letter-spacing:-0.5px; margin-bottom:1rem; line-height:1.25">
                Plataforma «No Molestar» del SERNAC: Cómo Bloquear Llamadas y Mensajes Spam en Chile
            </h1>
            <p style="font-size:1.08rem; color:var(--text-muted); line-height:1.7; max-width:850px">
                En Chile, la <strong>Ley del Consumidor (Ley N° 19.496)</strong> y las normativas de la <strong>Subsecretaría de Telecomunicaciones (SUBTEL)</strong> facultan a todos los ciudadanos a exigir que las empresas cesen las llamadas publicitarias, promocionales y de cobranza abusiva a sus celulares y teléfonos fijos.
            </p>
        </div>

        <!-- Callout Alert -->
        <div style="background:#eff6ff; border:1.5px solid #bfdbfe; border-radius:var(--radius-lg); padding:1.5rem; margin-bottom:2.5rem; display:flex; gap:1rem; align-items:flex-start">
            <span style="font-size:1.8rem; line-height:1">ℹ️</span>
            <div>
                <strong style="color:#1e3a8a; font-size:1rem; display:block; margin-bottom:0.35rem">¿Qué es el portal «No Molestar»?</strong>
                <p style="color:#1e40af; font-size:0.92rem; line-height:1.6; margin:0">
                    Es la herramienta digital gratuita administrada por el <strong>SERNAC (Servicio Nacional del Consumidor)</strong> que permite a los usuarios manifestar su voluntad de no recibir llamadas, SMS ni correos publicitarios no deseados. Las empresas notificadas están obligadas a suspender los envíos en un plazo máximo legal.
                </p>
            </div>
        </div>

        <!-- Steps Grid -->
        <h2 style="font-size:1.6rem; font-weight:800; color:var(--text-main); margin-bottom:1.5rem">
            Pasos para inscribir tu número en el SERNAC
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:1.5rem; margin-bottom:3rem">
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:1.75rem; box-shadow:var(--shadow)">
                <div style="font-size:2rem; margin-bottom:0.75rem">1️⃣</div>
                <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">Ingresá al portal SERNAC</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6">
                    Accedé a <strong>sernac.cl</strong> y dirigite a la sección <em>Portal del Consumidor</em> utilizando tu <strong>ClaveÚnica</strong> del Registro Civil.
                </p>
            </div>

            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:1.75rem; box-shadow:var(--shadow)">
                <div style="font-size:2rem; margin-bottom:0.75rem">2️⃣</div>
                <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">Seleccioná «No Molestar»</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6">
                    En el menú lateral hacé clic en la opción «No Molestar» y seleccioná «Ingresar nueva solicitud».
                </p>
            </div>

            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:1.75rem; box-shadow:var(--shadow)">
                <div style="font-size:2rem; margin-bottom:0.75rem">3️⃣</div>
                <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">Indicá tus números y empresas</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6">
                    Ingresá tus 9 dígitos de celular o línea fija y marcá las empresas o sectores (telecomunicaciones, bancos, seguros) de los que no deseás recibir llamados.
                </p>
            </div>
        </div>

        <!-- FAQ Section -->
        <h2 style="font-size:1.6rem; font-weight:800; color:var(--text-main); margin-bottom:1.5rem">
            Preguntas Frecuentes sobre la Normativa Chilena
        </h2>

        <div style="display:flex; flex-direction:column; gap:1rem; margin-bottom:3.5rem">
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem">
                <h3 style="font-size:1.05rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">¿Cuánto tarda en hacerse efectivo el bloqueo?</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6; margin:0">
                    Tras ser notificada por el SERNAC, la empresa dispone de <strong>un día hábil</strong> para eliminar tu número telefónico de sus bases de telemarketing y discadores automáticos.
                </p>
            </div>

            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem">
                <h3 style="font-size:1.05rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">¿Qué ocurre si continúan llamando?</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6; margin:0">
                    Podés realizar una denuncia por incumplimiento directamente en el SERNAC adjuntando la fecha y hora de la llamada. Las empresas se exponen a multas judiciales de hasta <strong>300 UTM</strong> por cada infracción.
                </p>
            </div>

            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem">
                <h3 style="font-size:1.05rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">¿El portal frena llamadas fraudulentas o estafas bancarias?</h3>
                <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6; margin:0">
                    No. Los delincuentes y estafadores operan al margen de la ley con números clonados o VoIP (prefijo 44). Para protegerte de estos fraudes, utilizá el <strong>buscador de QuiénLlama</strong> y descargá nuestros <strong>paquetes VCF</strong> para silenciarlos directamente en tu dispositivo.
                </p>
            </div>
        </div>

        <!-- External Link CTA -->
        <div style="background:linear-gradient(135deg, #0033a0, #001f66); color:white; border-radius:var(--radius-lg); padding:2rem; text-align:center; box-shadow:var(--shadow)">
            <h3 style="font-size:1.4rem; font-weight:900; margin-bottom:0.75rem">Acceso Oficial al Portal del Consumidor</h3>
            <p style="color:#cbd5e1; font-size:0.95rem; max-width:600px; margin:0 auto 1.5rem">
                Ingresá directamente al sitio web del Servicio Nacional del Consumidor de Chile para gestionar tus solicitudes.
            </p>
            <a href="https://www.sernac.cl/portal/618/w3-propertyvalue-63025.html" target="_blank" rel="noopener noreferrer" class="btn" style="background:#ffffff; color:#0033a0; font-weight:800; padding:0.85rem 1.75rem">
                Ir a SERNAC «No Molestar» ➔
            </a>
        </div>
    </div>
@endsection
