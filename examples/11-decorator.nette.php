<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
decorator:
	Project\ConsoleCommand:
		setup:
			- setFoo()
		tags:
			- console.command

services:
	- Project\Foo
	- Project\ConsoleFirstCommand
	- Project\ConsoleSecondCommand
NEON
);

dump($container->getByType(\Project\ConsoleFirstCommand::class));
dump($container->getByType(\Project\ConsoleSecondCommand::class));

dump($container->findByTag('console.command'));
dump($container->findByType(\Project\ConsoleCommand::class));
