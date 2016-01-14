<?php

namespace Project;



class NewsletterManager
{

    /**
     * @var Mailer
     */
    public $mailer;



    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

}
