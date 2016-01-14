<?php

namespace Project;



interface IMailerFactory
{

    /**
     * @return Mailer
     */
    public function create();

}
