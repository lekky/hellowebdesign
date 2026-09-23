<?php
// Intake form handler for /info/the-helium-hive/ (client-specific copy of /info/send-intake.php)
// Mirrors send.php: reCAPTCHA v3 verify + mail(), then redirect back to /info/.

// Google reCAPTCHA v3 Secret Key (same key pair as the main contact form)
$recaptcha_secret_key = '6LcixXcsAAAAAPVjW74kVI_QJ0UfGs5leIcsN0CZ';
$recaptcha_score_threshold = 0.5; // Scores below this are likely bots (0.0 = bot, 1.0 = human)

function redirect_back($status) {
    header("Location: /info/the-helium-hive/?status=" . $status);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /info/the-helium-hive/");
    exit();
}

// Honeypot: real people never fill the hidden "company_url" field. Bots do.
if (!empty($_POST['company_url'])) {
    redirect_back('success'); // pretend it worked; drop it silently
}

// --- Verify reCAPTCHA v3 (action 'intake') ---
if (empty($_POST['g-recaptcha-response'])) {
    redirect_back('error');
}

$verify_url = "https://www.google.com/recaptcha/api/siteverify";
$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query([
            'secret'   => $recaptcha_secret_key,
            'response' => $_POST['g-recaptcha-response'],
        ]),
    ],
];
$verify_result = @file_get_contents($verify_url, false, stream_context_create($options));
$captcha = $verify_result ? json_decode($verify_result) : null;

if (!$captcha
    || empty($captcha->success)
    || ($captcha->action ?? '') !== 'intake'
    || ($captcha->score ?? 0) < $recaptcha_score_threshold) {
    redirect_back('error');
}

// --- Server-side validation (never trust the browser) ---
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_back('error');
}

// --- Collect the answers, in a friendly reading order ---
function clean($v) {
    // Sanitize a single value or an array of values (checkbox groups) into a string.
    if (is_array($v)) {
        $v = array_map('clean', $v);
        return implode(', ', array_filter($v, fn($x) => $x !== ''));
    }
    return htmlspecialchars(strip_tags(trim((string) $v)), ENT_QUOTES, 'UTF-8');
}

// label => POST field name, in the order they appear on the form.
$fields = [
    'Package interest'   => 'package',
    'Timeline'           => 'timeline',
    'Budget'             => 'budget',
    'Other notes'        => 'anything',
    'Name'               => 'name',
    'Email'              => 'email',
];

$lines = [];
foreach ($fields as $label => $key) {
    $val = clean($_POST[$key] ?? '');
    if ($val !== '') {
        $lines[] = $label . ": " . $val;
    }
}

$to      = "contact@hellowebdesign.co.uk";
$subject = "The Helium Hive: intake answers from " . clean($name);
$body    = "New answers via the /info/the-helium-hive/ intake form:\n\n" . implode("\n", $lines) . "\n";

$headers  = "From: webmaster@hellowebdesign.co.uk\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    redirect_back('success');
} else {
    redirect_back('error');
}
