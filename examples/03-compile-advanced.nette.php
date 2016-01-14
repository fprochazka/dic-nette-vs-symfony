<?php

use Nette\Configurator;

require_once __DIR__ .'/bootstrap.php';

$config = (new Configurator())->setTempDirectory(TEMP_DIR);

$config->addConfig(asfile('config.neon', <<<NEON
parameters:
    mailer:
        transport: sendmail

services:
    mailer: Project\Mailer(%mailer.transport%)
    newsletter_manager: Project\NewsletterManager(@mailer)
NEON
));

$container = $config->createContainer();

dump($container->getService('newsletter_manager'));
