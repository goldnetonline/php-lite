<?php
/*
 * File: Mailer.php
 * Project: Contracts
 * File Created: Tuesday, 1st June 2021 9:50:00 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 1st June 2021 10:04:35 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2021, CamelCase Technologies Ltd
 */

namespace App\Core\Contracts;

interface Mailer
{

    /**
     * Single to or an array of to
     *
     * @param string|array $to
     */
    public function to($to): Self;

    /**
     * The subject of the email
     *
     * @param string $subject
     */
    public function subject(string $subject): Self;

    /**
     * The string message to send
     *
     * @param string $message
     */

    public function message(string $message): Self;

    /**
     * Compile a message tempplate to string
     *
     * @param string $template
     */
    public function template(string $template, array $context = []): Self;

    /**
     * Send the message
     */
    public function send(): Self;
}
