<?php

namespace App\Services;

use App\Models\Shipments;
use App\Repositories\ShipmentRepository;
use App\Repositories\UserRepository;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ShipmentService
{
    private ShipmentRepository $shipmentRepository;
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->shipmentRepository = new ShipmentRepository();
        $this->userRepository = new UserRepository();
    }
    public function create(int $userId, array $data): bool
    {
        $trackingNumber = $this->generateTrackingNumber();
            
        $shipment = new Shipments(
                null,
                $userId,
                $trackingNumber,
                1,
                $data['size'],
                $data['location_from'],
                $data['location_to'],
                $data['note'],
                $data['method'],
                $data['delivery']
            );

        $saved = $this->shipmentRepository->save($shipment);

        if($saved)
        {
            $userEmail = $this->userRepository->getUserEmailById($userId);
            $this->sendShipmentEmail($userEmail, $trackingNumber);
        }

        return  $saved;
    }

    public function generateTrackingNumber(): string
    {
        do{
            $trackingNumber = rand(10000000,99999999);
            $exists = $this->shipmentRepository->checkTrackingNumber($trackingNumber);
        }while($exists);

        return $trackingNumber;
    }

    private function sendShipmentEmail($userEmail, $trackingNumber): void
    {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@yourdomain.com', 'Your Company');
            $mail->addAddress($userEmail);  

            // Sadržaj emaila
            $mail->isHTML(true);
            $mail->Subject = 'Your Shipment Tracking Number';
            $mail->Body    = "Hello,<br><br>Your shipment has been created successfully. Your tracking number is <strong>{$trackingNumber}</strong>.<br>Thank you for using our service!<br><br>Best regards,<br>Your Company";
            $mail->AltBody = "Hello, Your shipment has been created successfully. Your tracking number is {$trackingNumber}. Thank you for using our service!";
            
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
