<?php
// Google reCAPTCHA v3 Secret Key
$recaptcha_secret_key = '6LcixXcsAAAAAPVjW74kVI_QJ0UfGs5leIcsN0CZ';
$recaptcha_score_threshold = 0.5; // Scores below this are likely bots (0.0 = bot, 1.0 = human)

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verify reCAPTCHA v3
    if (empty($_POST['g-recaptcha-response'])) {
        header("Location: /?status=error#contact");
        exit();
    }

    $recaptcha_response = $_POST['g-recaptcha-response'];
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $verify_result = file_get_contents($verify_url, false, $context);
    $captcha_success = json_decode($verify_result);

    // v3 checks: success, correct action, and score above threshold
    if (!$captcha_success->success
        || $captcha_success->action !== 'contact'
        || $captcha_success->score < $recaptcha_score_threshold) {
        header("Location: /?status=error#contact");
        exit();
    }

    // --- If reCAPTCHA passed, proceed with email sending ---

    // Function to ensure URL has a scheme
    function ensure_url_scheme($url) {
        if (empty($url)) {
            return '';
        }
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
        return $url;
    }

    // Collect and sanitize input data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'] ?? '')));
    $business_name = htmlspecialchars(strip_tags(trim($_POST['business_name'] ?? '')));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'] ?? '')));
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'] ?? '')));
    $existing_site = htmlspecialchars(strip_tags(trim($_POST['existing_site'] ?? '')));

    // Process existing_site_url
    $raw_existing_site_url = trim($_POST['existing_site_url'] ?? ''); // Get raw input
    $existing_site_url = ensure_url_scheme(htmlspecialchars(strip_tags($raw_existing_site_url))); // Sanitize and ensure scheme

    $interested_package = htmlspecialchars(strip_tags(trim($_POST['interested_package'] ?? '')));
    $referral_source = htmlspecialchars(strip_tags(trim($_POST['referral_source'] ?? '')));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));

    // Set recipient email address
    $to = "contact@hellowebdesign.co.uk"; // Your email address

    // Set email subject
    $subject = "New Contact Form Submission from Hello. Web Design";

    // Compose the email body
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Business Name: " . ($business_name ? $business_name : "N/A") . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Phone: " . ($phone ? $phone : "N/A") . "\n";
    $email_body .= "Existing Site: " . ($existing_site ? $existing_site : "N/A") . "\n";
    $email_body .= "Existing Site URL: " . ($existing_site_url ? $existing_site_url : "N/A") . "\n"; // Now includes scheme if user omitted
    $email_body .= "Interested Package: " . ($interested_package ? $interested_package : "Not specified") . "\n";
    $email_body .= "Where Did They Hear About Us: " . ($referral_source ? $referral_source : "Not specified") . "\n";
    $email_body .= "Message:\n" . $message . "\n";

    // Set email headers
    $headers = "From: webmaster@hellowebdesign.co.uk\r\n"; // IMPORTANT: Use an email address from your domain
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $email_body, $headers)) {
        // Redirect to a success page or show a success message
        header("Location: /?status=success#contact");
        exit();
    } else {
        // Redirect to an error page or show an error message
        header("Location: /?status=error#contact");
        exit();
    }
} else {
    // Not a POST request, redirect or show error
    header("Location: /");
    exit();
}
