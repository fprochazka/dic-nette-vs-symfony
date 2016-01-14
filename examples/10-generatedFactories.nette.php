<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
parameters:
	mailer:
		transport: sendmail

services:
	-
		implement: Project\IMailerFactory
		factory: Project\Mailer(%mailer.transport%)
NEON
);

$factory = $container->getByType(\Project\IMailerFactory::class);

dump($factory);
dump($factory->create());
dump($factory->create());
