<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Uups! Próba wysłania nieudana. Proszę, wypełnij formularz ponownie.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "kontakt@prekambr.pl";

        // Set the email subject.
        $subject = "Nowy kontakt od $name";

        // Build the email content.
        $email_content = "Imię: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Wiadomość:\n$message\n";

        // Build the email headers.
        $email_headers = "Od: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Dziękujemy! Twoja wiadomość została wysłana.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Uupss! Coś poszło nie tak. Twoja wiadomość nie została wysłana.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Wystąpił problem z Twoim formularzem. Prosimy spróbować ponownie.";
    }

?>
