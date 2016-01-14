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
    mailer: Project\Mailer(%mailer.transport%)
    newsletter_manager: Project\NewsletterManager(@mailer)
NEON
));

});

/** @var \Nette\DI\Container $container */
$container = new $class;

dump($container->getService('newsletter_manager'));
