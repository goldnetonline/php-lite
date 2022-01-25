<?php
/*
 * File: Smtp.php
 * Project: Mail
 * File Created: Tuesday, 1st June 2021 10:28:38 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 1st June 2021 12:17:38 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */
namespace App\Core\Mail;

class Smtp extends BaseMailDriver
{

    private $transport;
    private $mailer;

    /**
     * Configure the email engine
     */
    protected function configure(): Self
    {

        // Create the Transport
        $this->transport = (
            new \Swift_SmtpTransport(
                $this->config('host'),
                $this->config('port'),
            )
        )
            ->setUsername($this->config('username'))
            ->setPassword($this->config('password'))
            ->setStreamOptions([
                'ssl' => [
                    'allow_self_signed' => $this->config('allow_self_signed', true),
                    'verify_peer' => $this->config('allow_self_signed', false),
                ],
            ]);

        if ($this->config('encryption')) {
            $this->transport->setEncryption($this->config('encryption'));
        }

        $this->mailer = new \Swift_Mailer($this->transport);
        return $this;
    }

    /**
     * Send the message
     */
    public function send(): Self
    {
        $message = (new \Swift_Message(
            $this->subject
        ))->setFrom($this->from)
            ->setTo($this->toList)
            ->setBody($this->messageString, 'text/html')
            ->addPart(strip_tags($this->messageString), 'text/plain');

        $this->mailer->send($message);

        return $this;
    }
}
