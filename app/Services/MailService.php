<?php

namespace App\Services;

use App\Interfaces\EmailServiceInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../../vendor/autoload.php";

class MailService implements EmailServiceInterface
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setupSMTP();
    }

    private function setupSMTP()
    {
        try {
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com'; // SMTP server
            $this->mail->SMTPAuth = true;
            $this->mail->Username = ''; 
            $this->mail->Password = '';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;
            $this->mail->setFrom('shipment@gmail.com', 'Shipping App'); // Pošiljalac
        } catch (Exception $e) {
           var_dump($e->getMessage());
        }
    }

    public function sendEmail(string $to, string $subject, string $body): string
    {
        try {
            $this->mail->addAddress($to); 
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            return $this->mail->send();
        } catch (Exception $e) {
            var_dump($this->mail->ErrorInfo);
        }
    }
}
