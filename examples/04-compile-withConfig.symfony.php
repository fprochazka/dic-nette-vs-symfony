<?php

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ .'/bootstrap.php';


$file = TEMP_DIR . '/container.php';
$containerConfigCache = new ConfigCache($file, $isDebug = TRUE);

if (!$containerConfigCache->isFresh()) {
    $container = new ContainerBuilder();

    $loader = new YamlFileLoader($container, new FileLocator(TEMP_DIR));
    $loader->load(asfile('config.yml', <<<YAML
parameters:
    mailer.transport: sendmail

services:
    mailer:
        class:     Project\Mailer
        arguments: ['%mailer.transport%']
    newsletter_manager:
        class:     Project\NewsletterManager
        arguments: ["@mailer"]
YAML
));

    $dumper = new PhpDumper($container);
    file_put_contents($file, $dumper->dump());
}

require_once $file;
/** @var \Symfony\Component\DependencyInjection\Container $container */
$container = new ProjectServiceContainer();

dump($container->get('newsletter_manager'));
