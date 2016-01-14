<?php

use Nette\Configurator;

require_once __DIR__ .'/bootstrap.php';

$loader = new \Nette\DI\ContainerLoader(TEMP_DIR);
$class = $loader->load('', function (\Nette\DI\Compiler $compiler) {

    $compiler->loadConfig(asfile('config.neon', <<<NEON
parameters:
    mailer:
        transport: sendmail

services:
    mailer:
        class: Project\Mailer
        arguments: [%mailer.transport%]
    newsletter_manager:
        class: Project\NewsletterManager
        arguments: [@mailer]
NEON
));

});

/** @var \Nette\DI\Container $container */
$container = new $class;

dump($container->getService('newsletter_manager'));
