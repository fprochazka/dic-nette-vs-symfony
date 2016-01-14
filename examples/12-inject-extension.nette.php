<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
decorator:
	Project\IPresenter:
		inject: on

services:
	- Project\HomepagePresenter()
	- Project\NewsletterManager()
	- Project\Foo()
	- Project\Mailer(sendmail)
NEON
);

dump($container->getByType(\Project\HomepagePresenter::class));
