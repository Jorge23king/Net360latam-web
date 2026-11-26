# Web NET360 LATAM (net360latam.com)

Sitio estático: un solo `index.html`, sin compilación ni dependencias de servidor.

## Estructura
- `index.html`: página completa (secciones, promo Black Week, formulario, popup de privacidad y política).
- `assets/hark.css`, `assets/hark.js`: estilos y scripts base.
- `img/`: logo y fotografías (`s-*.png`).
- Fuente Poppins desde Google Fonts. El mapa es un iframe de Google Maps.

## Cómo publicar
1. Respaldar el sitio actual de net360latam.com (hoy es una SPA en React).
2. Subir el contenido de este repositorio a la raíz pública del hosting (`public_html/` o equivalente), manteniendo las carpetas `assets/` e `img/`.
3. Probar en escritorio y móvil, en una ventana de incógnito.

## Pendiente antes de salir a producción
- **Popup de privacidad:** aparece en cada carga. Para que recuerde la aceptación, guardarla en `localStorage` con la clave `net360_privacidad_v1` al pulsar "Aceptar y entrar", y no mostrar el popup si ya existe.
- **Formulario de contacto:** hoy no envía datos. Conectarlo a un endpoint (por ejemplo PHP mail o un formulario del servidor) que llegue a contacto@net360latam.com.
- **Casos de clientes:** los tres casos llevan la marca "Caso de ejemplo — reemplazar con cliente real". Hay que cambiarlos por casos reales o quitarlos.
- **Redes sociales:** los enlaces a LinkedIn, Facebook e Instagram van a las portadas genéricas. Hay que poner los perfiles reales de NET360.
- **Black Week:** la cuenta regresiva termina el 30-11-2026 a las 23:59 (Santiago). Después de esa fecha hay que retirar o actualizar la sección.
- **Imágenes:** pesan entre 1,2 y 1,6 MB. Se recomienda convertirlas a WebP o JPG optimizado.
- **SEO:** agregar las etiquetas og: y un favicon.
