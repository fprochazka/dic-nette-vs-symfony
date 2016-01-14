<?php

require_once __DIR__ .'/bootstrap.php';


// musí se zaregistrovat AutowirePass

$container = symfonyFromConfig(<<<YAML
parameters:
    mailer.transport: sendmail

services:
    mailer:
        class: Project\Mailer
        arguments: ['%mailer.transport%']
    newsletter_manager:
        class: Project\NewsletterManagerSetter
        properties:
            mailer: "@mailer"
        autowire: true
YAML
);

dump($container->get('newsletter_manager'));
