<?php

namespace Project;



class NewsletterManagerSetter
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
