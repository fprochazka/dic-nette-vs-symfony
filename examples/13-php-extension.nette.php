<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
php:
	date.timezone: Europe/Prague
	display_errors: 0
NEON
);

$container->initialize();
