<?php

/**
 * ══════════════════════════════════════════════════════════
 *  INTENSE PERU — Email Templates para intense_handle_contact
 *  Reemplaza la función en functions.php con esta versión.
 *
 *  Envía DOS correos:
 *    1. Email interno al equipo (sales@, karen@, juanpablo@)
 *    2. Auto-respuesta HTML al cliente
 * ══════════════════════════════════════════════════════════
 */

// ── Helper: Logo en base64 para máxima compatibilidad con clientes de email ───
// Incrusta el PNG como data URI — funciona en Gmail, Outlook, Apple Mail, etc.
// sin depender de que el servidor externo esté disponible al abrir el correo.
function intense_email_logo_src()
{
    static $cache = null;
    if ($cache !== null) return $cache;

    $path = WP_CONTENT_DIR . '/uploads/2026/04/intense_logo-1.png';

    if (file_exists($path)) {
        $data   = file_get_contents($path);
        $b64    = base64_encode($data);
        $cache  = 'data:image/png;base64,' . $b64;
    } else {
        // Fallback: URL absoluta (no funciona en Outlook, pero sí en Gmail/Apple Mail)
        $cache = content_url('/uploads/2026/04/intense_logo-1.png');
    }

    return $cache;
}

// ── Helper: Template interno (para el equipo) ─────────────────────────────────
function intense_email_contact_internal($data)
{
    $name      = esc_html($data['first_name'] . ' ' . $data['last_name']);
    $email     = esc_html($data['email']);
    $telephone = $data['telephone'] ? esc_html($data['telephone']) : '<em style="color:#9a9a8f;">—</em>';
    $mensaje   = nl2br(esc_html($data['mensaje']));
    $timestamp = current_time('d M Y · H:i');
    $logo_src  = intense_email_logo_src();

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Contact Message — Intense Peru</title>
</head>
<body style="margin:0;padding:0;background:#e8e4dc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#e8e4dc;padding:32px 16px;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">

  <!-- HEADER -->
  <tr>
    <td style="background:#1a1a18;padding:24px 40px;text-align:center;">
      <img src="{$logo_src}" alt="Intense Peru" width="160" style="display:block;margin:0 auto;max-width:160px;height:auto;border:0;">
    </td>
  </tr>

  <!-- HERO -->
  <tr>
    <td style="background:#c8923c;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">New Contact Message</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">A visitor submitted the contact form on intenseperu.com</p>
    </td>
  </tr>

  <!-- BODY -->
  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <!-- Alert strip -->
      <table width="100%" cellpadding="0" cellspacing="0" style="background:#fdf6ee;border:1px solid #e8d4b0;margin-bottom:20px;">
        <tr>
          <td style="padding:12px 16px;font-size:13px;color:#7a5c20;">
            ★ &nbsp;Reply directly to this email — the <strong>Reply-To</strong> is already set to the client's address.
          </td>
        </tr>
      </table>

      <!-- Badge -->
      <div style="display:inline-block;background:#f5f0e8;color:#c8923c;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:20px;">Contact Details</div>

      <!-- Fields -->
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">Name</td>
                <td style="font-size:14px;color:#1a1a18;">{$name}</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">Email</td>
                <td style="font-size:14px;color:#1a1a18;"><a href="mailto:{$email}" style="color:#c8923c;text-decoration:none;">{$email}</a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">Phone / WhatsApp</td>
                <td style="font-size:14px;color:#1a1a18;">{$telephone}</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <!-- Message box -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin:20px 0;">
        <tr>
          <td style="background:#f5f0e8;border-left:3px solid #c8923c;padding:16px 20px;">
            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#c8923c;margin-bottom:8px;">Message</div>
            <div style="font-size:14px;color:#3a3a35;line-height:1.6;font-style:italic;">{$mensaje}</div>
          </td>
        </tr>
      </table>

      <!-- Divider -->
      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#e8e0d0;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>

      <!-- Timestamp -->
      <p style="font-size:12px;color:#9a9a8f;margin:0;">Received: {$timestamp} &nbsp;·&nbsp; Source: Contact Form &nbsp;·&nbsp; intenseperu.com</p>

    </td>
  </tr>

  <!-- FOOTER -->
  <tr>
    <td style="background:#1a1a18;padding:26px 40px;text-align:center;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" style="padding-bottom:12px;">
            <a href="https://intenseperu.com" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Website</a>
            <a href="https://intenseperu.com/journeys" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Journeys</a>
            <a href="https://intenseperu.com/contact" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Contact</a>
          </td>
        </tr>
        <tr>
          <td align="center" style="padding-bottom:10px;font-size:12px;color:rgba(255,255,255,0.55);">
            <span style="color:#c8923c;">1 800 670 9510</span> Toll Free (US, CAN) &nbsp;·&nbsp; <span style="color:#c8923c;">+51 994 008 833</span> WhatsApp
          </td>
        </tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;">sales@intenseperu.com · intenseperu.com</td></tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;padding-top:4px;">© Intense Peru 2007 – 2026. All rights reserved. Lima, Perú</td></tr>
      </table>
    </td>
  </tr>

</table>
</td></tr>
</table>

</body>
</html>
HTML;
}


// ── Helper: Auto-respuesta al cliente ─────────────────────────────────────────
function intense_email_contact_autoreply($data)
{
    $first_name = esc_html($data['first_name']);
    $mensaje    = nl2br(esc_html($data['mensaje']));
    $logo_src   = intense_email_logo_src();

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>We received your message — Intense Peru</title>
</head>
<body style="margin:0;padding:0;background:#e8e4dc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#e8e4dc;padding:32px 16px;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">

  <!-- HEADER -->
  <tr>
    <td style="background:#1a1a18;padding:24px 40px;text-align:center;">
      <img src="{$logo_src}" alt="Intense Peru" width="160" style="display:block;margin:0 auto;max-width:160px;height:auto;border:0;">
    </td>
  </tr>

  <!-- HERO -->
  <tr>
    <td style="background:#c8923c;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">We received your message</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">Thank you for reaching out to Intense Peru</p>
    </td>
  </tr>

  <!-- BODY -->
  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <p style="font-size:15px;line-height:1.7;color:#3a3a35;margin:0 0 14px;">Dear <strong>{$first_name}</strong>,</p>

      <p style="font-size:15px;line-height:1.7;color:#3a3a35;margin:0 0 20px;">Thank you for contacting us. We have received your message and one of our travel advisors will get back to you within <strong>24 hours</strong>.</p>

      <!-- Message echo -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
        <tr>
          <td style="background:#f5f0e8;border-left:3px solid #c8923c;padding:16px 20px;">
            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#c8923c;margin-bottom:8px;">Your message</div>
            <div style="font-size:14px;color:#3a3a35;line-height:1.6;font-style:italic;">{$mensaje}</div>
          </td>
        </tr>
      </table>

      <p style="font-size:15px;line-height:1.7;color:#3a3a35;margin:0 0 24px;">While you wait, feel free to explore our signature journeys and destinations — Peru has a lot of magic in store for you.</p>

      <!-- CTA -->
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr>
          <td align="center">
            <a href="https://intenseperu.com/journeys" style="display:inline-block;background:#c8923c;color:#ffffff;text-decoration:none;padding:13px 32px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;">Explore Journeys</a>
          </td>
        </tr>
      </table>

      <!-- Divider -->
      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#e8e0d0;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>

      <p style="font-size:15px;line-height:1.7;color:#3a3a35;margin:0 0 14px;">If your request is urgent, you can reach us directly:</p>

      <!-- Contact fields -->
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">Toll Free</td>
                <td style="font-size:14px;color:#c8923c;font-weight:600;">1 800 670 9510 <span style="color:#9a9a8f;font-weight:normal;font-size:12px;">(US, CAN)</span></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">WhatsApp</td>
                <td style="font-size:14px;color:#c8923c;font-weight:600;">+51 994 008 833</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border-top:1px solid #e8e0d0;padding:10px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#c8923c;vertical-align:top;padding-top:2px;">Email</td>
                <td style="font-size:14px;color:#3a3a35;">sales@intenseperu.com</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    </td>
  </tr>

  <!-- FOOTER -->
  <tr>
    <td style="background:#1a1a18;padding:26px 40px;text-align:center;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" style="padding-bottom:12px;">
            <a href="https://intenseperu.com" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Website</a>
            <a href="https://intenseperu.com/journeys" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Journeys</a>
            <a href="https://intenseperu.com/contact" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Contact</a>
          </td>
        </tr>
        <tr>
          <td align="center" style="padding-bottom:10px;font-size:12px;color:rgba(255,255,255,0.55);">
            <span style="color:#c8923c;">1 800 670 9510</span> Toll Free (US, CAN) &nbsp;·&nbsp; <span style="color:#c8923c;">+51 994 008 833</span> WhatsApp
          </td>
        </tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;">sales@intenseperu.com · intenseperu.com</td></tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;padding-top:4px;">© Intense Peru 2007 – 2026. All rights reserved. Lima, Perú</td></tr>
      </table>
    </td>
  </tr>

</table>
</td></tr>
</table>

</body>
</html>
HTML;
}


// ── Handler principal: reemplaza el de functions.php ─────────────────────────
add_action('wp_ajax_intense_contact',        'intense_handle_contact');
add_action('wp_ajax_nopriv_intense_contact', 'intense_handle_contact');

function intense_handle_contact()
{
    check_ajax_referer('intense_forms_nonce', 'nonce');

    $first_name = sanitize_text_field($_POST['firstName'] ?? '');
    $last_name  = sanitize_text_field($_POST['lastName']  ?? '');
    $telephone  = sanitize_text_field($_POST['telephone'] ?? '');
    $email      = sanitize_email($_POST['email']          ?? '');
    $mensaje    = sanitize_textarea_field($_POST['mensaje'] ?? '');

    if (! $first_name || ! $email) {
        wp_send_json_error(['message' => 'Missing required fields.'], 400);
    }

    // ── Datos compartidos por los dos templates ───────────────────────────
    $data = compact('first_name', 'last_name', 'email', 'telephone', 'mensaje');

    $html_headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: {$first_name} {$last_name} <{$email}>",
    ];

    // ── 1. Email interno al equipo ────────────────────────────────────────
    $team_to      = ['sales@intenseperu.com', 'karen@intenseperu.com', 'juanpablo@intenseperu.com'];
    $team_subject = "New Contact Message — {$first_name} {$last_name}";
    $team_body    = intense_email_contact_internal($data);

    $sent = wp_mail($team_to, $team_subject, $team_body, $html_headers);

    // ── 2. Auto-respuesta al cliente ──────────────────────────────────────
    $auto_headers = ['Content-Type: text/html; charset=UTF-8'];
    $auto_subject = 'We received your message — Intense Peru';
    $auto_body    = intense_email_contact_autoreply($data);

    wp_mail($email, $auto_subject, $auto_body, $auto_headers);

    // ── Respuesta AJAX ────────────────────────────────────────────────────
    if ($sent) {
        wp_send_json_success(['message' => 'Email sent.']);
    } else {
        wp_send_json_error(['message' => 'Could not send email.'], 500);
    }
}
