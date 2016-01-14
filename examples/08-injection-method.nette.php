<?php

require_once __DIR__ .'/bootstrap.php';


$container = netteFromConfig(<<<NEON
parameters:
	mailer:
		transport: sendmail

services:
	- Project\Mailer(%mailer.transport%)
	-
		class: Project\NewsletterManagerSetter
		setup:
			- setMailer()
NEON
);

dump($container->getByType(\Project\NewsletterManagerSetter::class));
