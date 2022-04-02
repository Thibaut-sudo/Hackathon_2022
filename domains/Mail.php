<?php
const WEBMASTEREMAIL = 'careersatdeloitte@deloitte.be';

class Mail
{
    function envoyerMail($emailClient, $sujet, $content, &$message)
    {
        $mailClient = new PHPMailer(true);
        try {
            $mailClient->CharSet = 'UTF-8';
            $mailClient->setFrom(WEBMASTEREMAIL);
            $mailClient->addReplyTo(WEBMASTEREMAIL);
            $mailClient->addAddress("$emailClient");
            $mailClient->isHTML(true);
            $mailClient->Subject =   $sujet;
            $mailClient->Body = "$content <br>";
            $mailClient->send();
        } catch (Exception $e) {
            $message .= "Erreur survenue lors de l\'envoi de l\'email<br>";
        }
    }
}