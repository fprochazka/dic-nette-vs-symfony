<?php

namespace Project;



class NewsletterManager
{

    /**
     * @var Mailer
     */
    private $mailer;



    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

}
