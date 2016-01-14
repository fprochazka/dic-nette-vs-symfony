<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
decorator:
	Project\IPresenter:
		inject: on

services:
	- Project\HomepagePresenter
NEON
);

dump($container->getByType(\Project\ConsoleFirstCommand::class));
dump($container->getByType(\Project\ConsoleSecondCommand::class));

dump($container->findByTag('console.command'));
dump($container->findByType(\Project\ConsoleCommand::class));
