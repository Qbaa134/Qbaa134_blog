<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Zabezpieczenie przed XSS
    $userName = htmlspecialchars($_POST['userName']);
    $userComment = htmlspecialchars($_POST['userComment']);
    $rating = $_POST['rating'];

    // Adres e-mail, na który będą wysyłane komentarze
    $to = "qbaa134.pl@gmail.com";
    $subject = "Nowy komentarz na stronie";

    // Treść e-maila
    $message = "Nowy komentarz:\n\n";
    $message .= "Imię: $userName\n";
    $message .= "Komentarz: $userComment\n";
    $message .= "Ocena: $rating gwiazdek\n";
    $headers = "From: no-reply@yourwebsite.com" . "\r\n" . "Content-type: text/plain; charset=UTF-8";

    // Wysłanie e-maila
    if (mail($to, $subject, $message, $headers)) {
        echo "Dziękujemy za komentarz!";
    } else {
        echo "Wystąpił błąd przy wysyłaniu komentarza.";
    }
}
?>
