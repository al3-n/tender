<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21.11.16
 * Time: 15:25
 */
namespace Tender\Mail;

class Message
{
    protected $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function to($address)
    {
        $this->mailer->addAddress($address);
    }

    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function body($body)
    {
        $this->mailer->Body = $body;
    }
}