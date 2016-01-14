<?php

use Symfony\Component\DependencyInjection\Container;

require_once __DIR__ .'/bootstrap.php';

$container = new Container();

$container->set('foo', new stdClass());
dump($container->get('foo'));

$container->setParameter('bar', TRUE);
dump($container->getParameterBag()->all());
