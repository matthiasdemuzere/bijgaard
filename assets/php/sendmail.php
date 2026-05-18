<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // This email is the primary recipient and visible to the sender
    $to = 'moestuin@bijgaard.be';  // Adjust this email address as necessary

    // Email address that you want to BCC; this email is hidden from the primary recipient
    $bccEmail = $email;

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>\r\n";
    $email_headers .= "Bcc: $bccEmail\r\n"; // Add the Bcc header

    // Send the email.
    if(mail($to, $subject, $email_content, $email_headers)) {
        // Redirect to a thank-you page or back to the form page with a success message.
        header("Location: ../../thankyou.html");
        exit;
    } else {
        // Handle error
        echo "Oeps, er ging iets fout. Probeer je eens opnieuw?";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "Oeps, er ging iets fout. Probeer je eens opnieuw?";
}
?>

