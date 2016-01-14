<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ .'/bootstrap.php';

$container = new ContainerBuilder();

$container->setParameter('mailer.transport', 'sendmail');
$container
    ->register('mailer', \Project\Mailer::class)
    ->addArgument('%mailer.transport%');

$container
    ->register('newsletter_manager', \Project\NewsletterManager::class)
    ->addArgument(new Reference('mailer'));

dump($container->get('newsletter_manager'));
