<?php
// Formulario "Agendar demo" de net360latam.com → contacto@net360latam.com
// Requiere hosting con PHP y la función mail() habilitada (p. ej. DonWeb/Ferozo).
// Recomendado: crear en el hosting la casilla web@net360latam.com (o usar la que exista)
// y que el dominio tenga SPF que autorice al servidor, para que el correo no caiga en spam.

header('Content-Type: application/json; charset=utf-8');

$DESTINO   = 'contacto@net360latam.com';
$REMITENTE = 'web@net360latam.com';   // cambiar si el hosting exige otra casilla del dominio

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['ok'=>false,'error'=>'Método no permitido']); exit; }

// Honeypot anti-spam: el campo "sitio" debe venir vacío
if (!empty($_POST['sitio'])) { echo json_encode(['ok'=>true]); exit; }

function campo($k, $max = 200) {
  $v = isset($_POST[$k]) ? trim((string)$_POST[$k]) : '';
  $v = str_replace(["\r", "\0"], '', $v);
  return mb_substr($v, 0, $max);
}

$nombre   = campo('nombre');
$empresa  = campo('empresa');
$correo   = campo('correo');
$telefono = campo('telefono', 40);
$necesita = campo('necesita', 60);
$mensaje  = campo('mensaje', 3000);

if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo json_encode(['ok'=>false,'error'=>'Revisa tu nombre y correo.']);
  exit;
}

$asunto = '=?UTF-8?B?' . base64_encode("[Demo web] $necesita - " . ($empresa !== '' ? $empresa : $nombre)) . '?=';
$cuerpo = "Nueva solicitud de demo desde net360latam.com\n\n"
        . "Nombre: $nombre\nEmpresa: $empresa\nCorreo: $correo\nTeléfono: $telefono\n"
        . "Necesita: $necesita\n\nMensaje:\n$mensaje\n\n"
        . "Fecha: " . date('Y-m-d H:i') . "  IP: " . ($_SERVER['REMOTE_ADDR'] ?? '') . "\n";
$cabeceras = "From: Web NET360 <$REMITENTE>\r\n"
           . "Reply-To: " . str_replace(["\n","\r"], '', $correo) . "\r\n"
           . "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n";

$ok = @mail($DESTINO, $asunto, $cuerpo, $cabeceras, "-f$REMITENTE");
if (!$ok) { http_response_code(500); echo json_encode(['ok'=>false,'error'=>'No se pudo enviar. Escríbenos a contacto@net360latam.com.']); exit; }
echo json_encode(['ok'=>true]);
