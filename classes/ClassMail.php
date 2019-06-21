<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ClassMail {

    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
    }
    
    #envio de email
    public function sendMail($email, $nome, $token = null, $assunto, $corpoEmail) {
        try {
            //Server settings
            $this->mail->isSMTP();                // Set mailer to use SMTP
            $this->mail->Host       = HOSTMAIL;   // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;       // Enable SMTP authentication
            $this->mail->Username   = USERMAIL;   // SMTP username
            $this->mail->Password   = PASSMAIL;   // SMTP password
            $this->mail->SMTPSecure = 'ssl';      // Enable SSL encryption
            $this->mail->Port       = PORTMAIL;   // TCP port to connect to
            $this->mail->CharSet    = 'utf-8';
        
            //Recipients
            $this->mail->setFrom('contato@polignonews.com.br', 'Poligno News');
            $this->mail->addAddress($email, $nome);
        
            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $assunto;
            $this->mail->Body    = $corpoEmail;
        
            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}