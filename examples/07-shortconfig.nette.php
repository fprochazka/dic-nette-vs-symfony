<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
parameters:
    mailer:
        transport: sendmail

services:
    - Project\Mailer(%mailer.transport%)
    - Project\NewsletterManager()
NEON
);

dump($container->getByType(\Project\NewsletterManager::class));
