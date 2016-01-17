<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<'NEON'
parameters:
    mailer:
        transport: sendmail

services:
    mailer:
        class: Project\Mailer
        arguments: [%mailer.transport%]
    newsletter_manager:
        class: Project\NewsletterManager
NEON
);

dump($container->getService('newsletter_manager'));
