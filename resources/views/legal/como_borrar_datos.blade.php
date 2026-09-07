@extends('layouts.app')

@section('title', '¿Cómo hacer que borren mis datos personales y dejen de llamarme? (Guía Chile) - QuiénLlama')
@section('meta_description', 'Descubre cómo eliminar tu número de teléfono y datos personales de bases de telemarketing, data brokers y listas de spam en Chile. Guía paso a paso sobre SERNAC No Molestar e Incogni.')

@section('content')
<div class="content-tool" style="max-width: 980px; margin: 0 auto; padding: 1.5rem 1rem 3.5rem;">
    
    <!-- Breadcrumb & Badges -->
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('home') }}" class="back-link" style="display:inline-flex; align-items:center; gap:6px; color:var(--text-muted); text-decoration:none; font-size:0.9rem; margin-bottom:1rem;">
            &larr; Volver al buscador principal
        </a>
        <div style="display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
            <span style="background: rgba(0, 51, 160, 0.1); color: var(--primary); font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 9999px; border: 1px solid rgba(0, 51, 160, 0.2);">
                🇨🇱 Guía de Privacidad y Derechos ARCO Chile 2026
            </span>
            <span style="background: #f0fdf4; color: #166534; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 9999px; border: 1px solid #86efac;">
                🛡️ Protección de Datos Personales (Ley 19.628)
            </span>
        </div>
    </div>

    <!-- Hero Title -->
    <div style="margin-bottom: 2.5rem;">
        <h1 style="font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 900; color: var(--text-main); letter-spacing: -0.5px; line-height: 1.25; margin-bottom: 1rem;">
            ¿Cómo hacer que borren mis datos y dejen de llamarme a mi celular en Chile?
        </h1>
        <p style="font-size: 1.12rem; color: var(--text-muted); line-height: 1.7; max-width: 850px;">
            ¿Te llaman insistentemente ofreciéndote créditos de consumo, portabilidad telefónica, seguros automotrices o cobranzas desconocidas? Conoce cómo terminaron tus datos en esas listas, cómo utilizar el portal <strong>No Molestar del SERNAC</strong> y por qué un servicio como <strong>Incogni</strong> te permite borrar tu información de raíz en cientos de bases de datos.
        </p>
    </div>

    <!-- Alerta Contextual: El origen del problema -->
    <div style="background: #fffbeb; border: 1.5px solid #fde68a; border-radius: var(--radius-lg); padding: 1.5rem; margin-bottom: 2.5rem; display: flex; gap: 1rem; align-items: flex-start;">
        <span style="font-size: 2rem; line-height: 1;">⚠️</span>
        <div>
            <strong style="color: #92400e; font-size: 1.05rem; display: block; margin-bottom: 0.4rem;">¿Por qué tienen tu número, tu nombre y tu RUT?</strong>
            <p style="color: #78350f; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                Cuando compras en grandes tiendas comerciales, descargas apps móviles, cotizas seguros o pides presupuestos por internet, tus datos a menudo son compartidos o vendidos a intermediarios de información (<em>Data Brokers</em>). Estas empresas crean perfiles con tu RUT, teléfono móvil, dirección y correo electrónico, vendiéndolos a discadores automáticos y call centers.
            </p>
        </div>
    </div>

    <!-- Card de Presentación Incogni (Hero CTA) -->
    <div style="background: linear-gradient(135deg, #0b1528 0%, #172554 100%); border-radius: var(--radius-lg); padding: clamp(1.5rem, 3.5vw, 2.5rem); color: white; margin-bottom: 3rem; box-shadow: 0 12px 28px rgba(11, 21, 40, 0.25); border: 1px solid rgba(255, 255, 255, 0.1);">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(255, 255, 255, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.6rem;">
                    🛡️
                </div>
                <div>
                    <span style="text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #93c5fd; font-weight: 800;">Solución Automatizada Internacional</span>
                    <h2 style="font-size: 1.6rem; font-weight: 800; color: white; margin: 0; line-height: 1.2;">Incogni: La herramienta que borra tus datos por ti</h2>
                </div>
            </div>
            <span style="background: rgba(34, 197, 94, 0.2); border: 1px solid #4ade80; color: #86efac; font-size: 0.82rem; font-weight: 700; padding: 4px 12px; border-radius: 9999px;">
                Creado por Surfshark
            </span>
        </div>

        <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.65; margin-bottom: 1.5rem; max-width: 820px;">
            <strong>Incogni</strong> actúa como tu representante legal digital. En lugar de tener que enviar cientos de correos o formularios solicitando el borrado de tus datos, Incogni contacta de manera recurrente y automática a más de <strong>180 intermediarios de datos (data brokers)</strong>, agencias de prospección comercial y bases de reclutamiento para exigir la eliminación total de tus registros personales.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: rgba(255, 255, 255, 0.07); padding: 1rem; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.08);">
                <span style="font-size: 1.2rem; display: block; margin-bottom: 0.3rem;">⚡</span>
                <strong style="color: white; font-size: 0.95rem; display: block;">100% Automático</strong>
                <span style="color: #94a3b8; font-size: 0.85rem;">Tú sólo te registras una vez; Incogni envía y da seguimiento a las solicitudes de borrado.</span>
            </div>
            <div style="background: rgba(255, 255, 255, 0.07); padding: 1rem; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.08);">
                <span style="font-size: 1.2rem; display: block; margin-bottom: 0.3rem;">📉</span>
                <strong style="color: white; font-size: 0.95rem; display: block;">Menos Spam y Robocalls</strong>
                <span style="color: #94a3b8; font-size: 0.85rem;">Al no encontrar tu número en los catálogos de venta, los call centers reducen drásticamente las llamadas.</span>
            </div>
            <div style="background: rgba(255, 255, 255, 0.07); padding: 1rem; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.08);">
                <span style="font-size: 1.2rem; display: block; margin-bottom: 0.3rem;">📊</span>
                <strong style="color: white; font-size: 0.95rem; display: block;">Panel de Seguimiento</strong>
                <span style="color: #94a3b8; font-size: 0.85rem;">Supervisa en tiempo real qué bases de datos ya borraron tu información y cuáles están en proceso.</span>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1.25rem;">
            <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_landing_hero_cl" 
               target="_blank" rel="noopener nofollow sponsored" 
               class="btn-incogni-cta"
               onclick="if(typeof trackGoal==='function'){trackGoal('incogni_landing_click', {event_label:'hero_cta_cl'});} if(typeof gtag==='function'){gtag('event','click_incogni_landing',{'placement':'hero_cl'});}"
               style="background: #2563eb; color: white; font-weight: 800; font-size: 1.05rem; padding: 0.9rem 1.8rem; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4); transition: transform 0.2s, background 0.2s;">
                <span>Probar Incogni y Borrar mis Datos</span>
                <span>&rarr;</span>
            </a>
            <span style="color: #94a3b8; font-size: 0.85rem;">Garantía de reembolso de 30 días · Cancela cuando quieras</span>
        </div>
    </div>

    <!-- Comparativa: SERNAC vs Incogni -->
    <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.75rem;">
            ¿Qué diferencia hay entre el SERNAC y un servicio como Incogni?
        </h2>
        <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.6; margin-bottom: 1.5rem;">
            Muchos usuarios en Chile se preguntan si inscribirse en la plataforma estatal <strong>No Molestar del SERNAC</strong> es suficiente o si necesitan una herramienta complementaria:
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Columna SERNAC -->
            <div style="background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow);">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                    <span style="font-size: 1.5rem;">🇨🇱</span>
                    <h3 style="font-size: 1.25rem; font-weight: 800; color: #0033a0; margin: 0;">SERNAC «No Molestar»</h3>
                </div>
                <ul style="padding-left: 1.25rem; color: var(--text-muted); font-size: 0.92rem; line-height: 1.65; margin-bottom: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;"><strong>Es gratuito y oficial:</strong> Tramitado a través de sernac.cl con ClaveÚnica.</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Empresas formales:</strong> Aplica a empresas nacionales que operan formalmente en Chile (bancos, retail, telefonía fija y móvil).</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Límite:</strong> No cubre empresas informales, intermediarios offshore ni bases de datos comercializadas en el mercado negro.</li>
                    <li><strong>Requiere gestión manual:</strong> Tienes que seleccionar manualmente qué proveedores bloquear.</li>
                </ul>
                <a href="{{ route('legal.no-molestar') }}" style="display: inline-block; color: #0033a0; font-weight: 700; font-size: 0.9rem; text-decoration: underline;">
                    Ver guía de inscripción en SERNAC &rarr;
                </a>
            </div>

            <!-- Columna Incogni -->
            <div style="background: white; border: 1.5px solid #93c5fd; border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow);">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                    <span style="font-size: 1.5rem;">🛡️</span>
                    <h3 style="font-size: 1.25rem; font-weight: 800; color: #1d4ed8; margin: 0;">Incogni (Data Broker Removal)</h3>
                </div>
                <ul style="padding-left: 1.25rem; color: var(--text-muted); font-size: 0.92rem; line-height: 1.65; margin-bottom: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;"><strong>Ataca la raíz del problema:</strong> Borra tu número y correo de los catálogos globales de intermediarios de datos.</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Más de 180 empresas cubiertas:</strong> Exige la eliminación legal de tus perfiles a nivel internacional.</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Monitoreo continuo:</strong> Los intermediarios vuelven a recopilar datos; Incogni envía solicitudes periódicas para mantenerte limpio.</li>
                    <li><strong>Previene estafas:</strong> Reduce el riesgo de que tus datos caigan en manos de redes de phishing o suplantación telefónica.</li>
                </ul>
                <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_landing_mid_cl" 
                   target="_blank" rel="noopener nofollow sponsored" 
                   onclick="if(typeof trackGoal==='function'){trackGoal('incogni_landing_click', {event_label:'compare_card_cl'});}"
                   style="display: inline-block; color: #1d4ed8; font-weight: 700; font-size: 0.9rem; text-decoration: underline;">
                    Conocer planes y descuentos en Incogni &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Guía Paso a Paso: Cómo hacer que borren tus datos -->
    <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.25rem;">
            Estrategia en 4 pasos para blindar tu número de teléfono en Chile
        </h2>

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; display: flex; gap: 1.25rem; align-items: flex-start; box-shadow: var(--shadow);">
                <div style="background: #eff6ff; color: #0033a0; font-weight: 900; font-size: 1.2rem; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    1
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                        Inscribe tus números en «No Molestar» del SERNAC
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                        Entra con tu ClaveÚnica en <strong>sernac.cl</strong> y agrega tu número celular y teléfono fijo. Esto te protegerá formalmente ante operadores móviles (Entel, Movistar, Claro, WOM), bancos y tiendas comerciales.
                    </p>
                </div>
            </div>

            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; display: flex; gap: 1.25rem; align-items: flex-start; box-shadow: var(--shadow);">
                <div style="background: #eff6ff; color: #0033a0; font-weight: 900; font-size: 1.2rem; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    2
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                        Elimina tu registro de bases de datos globales con Incogni
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                        Al darte de alta en <strong>Incogni</strong>, autorizas al servicio a enviar solicitudes legales formales a más de 180 intermediarios de información. Incogni verifica el cumplimiento y te avisa cuando las bases de datos eliminan tu información.
                    </p>
                </div>
            </div>

            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; display: flex; gap: 1.25rem; align-items: flex-start; box-shadow: var(--shadow);">
                <div style="background: #eff6ff; color: #0033a0; font-weight: 900; font-size: 1.2rem; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    3
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                        Bloquea números molestos con la lista VCF de QuiénLlama
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                        Descarga nuestro archivo de contactos de bloqueo masivo (VCF) actualizado para Chile e impórtalo en tu celular para silenciar al instante los números más denunciados de la semana.
                    </p>
                </div>
            </div>

            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; display: flex; gap: 1.25rem; align-items: flex-start; box-shadow: var(--shadow);">
                <div style="background: #eff6ff; color: #0033a0; font-weight: 900; font-size: 1.2rem; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    4
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                        Ejerce tu Derecho de Cancelación (Derechos ARCO Ley 19.628)
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                        Si una empresa te llama insistentemente, indícale al ejecutivo: <em>«Exijo el ejercicio de mi derecho de cancelación y eliminación de mis datos conforme a la Ley N° 19.628 de Protección de Datos»</em>. Están obligados legalmente a borrarte de sus registros.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Preguntas Frecuentes (FAQ) -->
    <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.5rem;">
            Preguntas Frecuentes sobre la Eliminación de Datos
        </h2>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow);">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">
                    ¿Cuánto tiempo tarda en notarse la reducción de llamadas?
                </h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    Con el portal del SERNAC, las empresas inscritas tienen un plazo legal para suspender comunicaciones. Con Incogni, los intermediarios de datos procesan las solicitudes entre 30 y 45 días. En la mayoría de los usuarios, las llamadas disminuyen progresivamente hasta en un 80-90% durante el primer trimestre.
                </p>
            </div>

            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow);">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">
                    ¿Es seguro autorizar a Incogni para gestionar mis datos?
                </h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    Sí. Incogni es una empresa de ciberseguridad desarrollada por el equipo de <strong>Surfshark</strong>. Opera bajo estrictos estándares de privacidad internacionales (GDPR y CCPA). Únicamente solicita los datos imprescindibles para poder identificarte ante los data brokers y demandar que te eliminen.
                </p>
            </div>

            <div style="background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow);">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">
                    ¿Qué pasa si me siguen llamando por deudas de otra persona?
                </h3>
                <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    En Chile, la ley prohíbe el acoso extrajudicial y las llamadas a terceros que no son deudores ni avales. Si te llaman por un desconocido, presenta una denuncia formal en el portal del SERNAC o mediante la Ley N° 19.496 indicando que ese teléfono ya no pertenece al titular de la deuda.
                </p>
            </div>
        </div>
    </div>

    <!-- Banner Final CTA -->
    <div style="background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: var(--radius-lg); padding: 2rem; text-align: center; box-shadow: var(--shadow);">
        <h3 style="font-size: 1.4rem; font-weight: 800; color: #1e3a8a; margin-bottom: 0.75rem;">
            ¿Listo para recuperar tu tranquilidad y privacidad?
        </h3>
        <p style="color: #1e40af; font-size: 0.95rem; line-height: 1.6; max-width: 650px; margin: 0 auto 1.5rem;">
            Deja que Incogni trabaje en segundo plano limpiando tu rastro digital en más de 180 empresas de datos mientras tú disfrutas de tu celular sin interrupciones.
        </p>
        <a href="https://deal.incogni.io/aff_c?offer_id=2&aff_id=2891&aff_sub=ql_landing_faq_cl" 
           target="_blank" rel="noopener nofollow sponsored" 
           class="btn-incogni-cta"
           onclick="if(typeof trackGoal==='function'){trackGoal('incogni_landing_click', {event_label:'bottom_cta_cl'});} if(typeof gtag==='function'){gtag('event','click_incogni_landing',{'placement':'bottom_cl'});}"
           style="background: #2563eb; color: white; font-weight: 800; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 10px; text-decoration: none; display: inline-block; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4); transition: transform 0.2s;">
            🛡️ Activar Protección con Incogni
        </a>
    </div>

</div>

<!-- Schema.org FAQPage -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "¿Cómo hacer que borren mis datos de telemarketing en Chile?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Para evitar que los call centers sigan llamando a tu celular en Chile, puedes inscribirte en la plataforma No Molestar del SERNAC y utilizar herramientas de privacidad como Incogni para exigir el borrado de tus datos ante más de 180 intermediarios de información."
      }
    },
    {
      "@@type": "Question",
      "name": "¿Es seguro utilizar Incogni para eliminar datos en Chile?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Sí, es completamente seguro. Incogni fue desarrollado por Surfshark y únicamente gestiona solicitudes formales de eliminación de datos de contacto ante intermediarios de bases de datos."
      }
    },
    {
      "@@type": "Question",
      "name": "¿Qué diferencia hay entre el SERNAC e Incogni?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "El SERNAC gestiona la exclusión publicitaria obligatoria frente a empresas formalmente constituidas en Chile, mientras que Incogni actúa a nivel de la infraestructura global de intermediarios de datos (data brokers), impidiendo que tu número sea revendido a listas masivas."
      }
    }
  ]
}
</script>
@endsection
