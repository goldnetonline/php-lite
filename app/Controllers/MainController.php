<?php
/*
 * File: MainController.php
 * Project: Controllers
 * File Created: Monday, 24th May 2021 12:12:31 am
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 25th January 2022 11:20:15 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Mail\Mail;

class MainController extends BaseController
{
    public function controller()
    {
        $mail = new Mail;
        $mail->to('email@example.com')->subject('Test Email')->template('mail/contact.html',
            [
                'website_name' => 'Acme',
                'name' => 'Ben Carson',
                'email' => 'ben@carson.com',
                'message' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quasi ab voluptatibus, eaque rem eos accusamus, natus aspernatur sequi illo pariatur reprehenderit error praesentium ea nam laborum facere et similique repellat dolore quia expedita maxime mollitia. Tempora ratione quibusdam nisi dicta dolor, asperiores pariatur libero, ducimus voluptatum magnam impedit architecto facilis dolorem commodi alias illo in, aliquid quaerat laboriosam consequatur non aliquam magni deserunt? Dolores praesentium eum, officiis repudiandae veritatis officia corrupti harum, aliquid nam quasi molestiae unde, laudantium excepturi expedita enim quia. Iure voluptatum quisquam rem similique delectus voluptatem vel. Voluptatem aliquam obcaecati quaerat tempore nostrum officia ratione error? ',
            ]
        )->send();
        return "Mail Send";

    }

    public function contact()
    {

        $mail = new Mail;
        $mail->to('info@example.com')->subject('Contact Form on Acme Website')->template('mail/contact.html',
            [
                'website_name' => 'Acme',
                'name' => $this->request->input('name'),
                'email' => $this->request->input('email'),
                'message' => nl2br($this->request->input('message')),
            ]
        )->send();
        return [
            'success' => true,
            'message' => 'Enquiry Recieved',
            'data' => $this->request->all(),
        ];

    }
}
