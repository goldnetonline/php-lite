<?php
/*
 * File: Mailgun.php
 * Project: Mail
 * File Created: Tuesday, 1st June 2021 12:52:13 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 1st June 2021 1:36:08 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core\Mail;

use Mailgun\Mailgun as MailgunEngine;

class Mailgun extends BaseMailDriver
{

    private $apiKey;
    private $mailer;

    /**
     * Configure the email engine
     */
    protected function configure(): Self
    {
        $this->apiKey = trim($this->config('api_key'));
        $this->mailer = MailgunEngine::create($this->apiKey);
        $this->from($this->config('mail_from'));

        return $this;
    }

    /**
     * Send the message
     */
    public function send(): Self
    {

        $this->mailer->messages()->send(
            $this->config('domain_name'), [
                'from' => $this->from,
                'to' => $this->toList,
                'subject' => $this->subject,
                'text' => strip_tags($this->messageString),
                'html' => $this->messageString,
            ]
        );

        return $this;
    }
}
