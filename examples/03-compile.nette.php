<?php

require_once __DIR__ .'/bootstrap.php';

$loader = new \Nette\DI\ContainerLoader(TEMP_DIR);
$class = $loader->load('', function (\Nette\DI\Compiler $compiler) {
    $builder = $compiler->getContainerBuilder();

    $builder->parameters['mailer']['transport'] = 'sendmail';

    $builder->addDefinition('mailer')
        ->setClass(\Project\Mailer::class)
        ->setArguments([$builder->parameters['mailer']['transport']]);

    $builder->addDefinition('newsletter_manager')
        ->setClass('Project\NewsletterManager')
        ->setArguments(['@mailer']);
});

/** @var \Nette\DI\Container $container */
$container = new $class;

dump($container->getService('newsletter_manager'));
