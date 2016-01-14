<?php

namespace Project;



class Mailer
{

    /**
     * @var string
     */
    private $transport;



    public function __construct($transport)
    {
        $this->transport = $transport;
    }

    // ...
}
