<?php

require_once __DIR__ .'/bootstrap.php';

$container = new \Nette\DI\Container();

$container->addService('foo', new stdClass());
dump($container->getService('foo'));

$container->parameters['bar'] = TRUE;
dump($container->parameters);
