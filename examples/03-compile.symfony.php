<?php

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ .'/bootstrap.php';


$file = TEMP_DIR . '/container.php';
$containerConfigCache = new ConfigCache($file, $isDebug = TRUE);

if (!$containerConfigCache->isFresh()) {
    $container = new ContainerBuilder();

    $container->setParameter('mailer.transport', 'sendmail');
    $container
        ->register('mailer', \Project\Mailer::class)
        ->addArgument('%mailer.transport%');

    $container
        ->register('newsletter_manager', \Project\NewsletterManager::class)
        ->addArgument(new Reference('mailer'));

    $container->compile();

    $dumper = new PhpDumper($container);
    file_put_contents($file, $dumper->dump());
}

require_once $file;
/** @var \Symfony\Component\DependencyInjection\Container $container */
$container = new ProjectServiceContainer();

dump($container->get('newsletter_manager'));
