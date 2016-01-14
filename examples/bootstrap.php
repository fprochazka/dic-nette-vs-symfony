<?php

use Nette\Utils\FileSystem;
use Tracy\Debugger;



require_once __DIR__ . '/../vendor/autoload.php';

define('TEMP_DIR', __DIR__ . '/../tmp/' . basename($_SERVER['SCRIPT_NAME'], '.php') . '/' . getmypid());
FileSystem::createDir(TEMP_DIR);

Debugger::enable(FALSE, __DIR__ . '/../tmp');
Debugger::$strictMode = TRUE;

function asfile($name, $content)
{
	file_put_contents($filepath = TEMP_DIR . '/' . $name, $content);

	return $filepath;
}

/**
 * @return \Nette\DI\Container
 */
function netteFromConfig($config)
{
	$loader = new \Nette\DI\ContainerLoader(TEMP_DIR);
	$class = $loader->load(
		'',
		function (\Nette\DI\Compiler $compiler) use ($config) {
			$compiler->addExtension('php', new \Nette\DI\Extensions\PhpExtension());
			$compiler->addExtension('decorator', new \Nette\DI\Extensions\DecoratorExtension());
			$compiler->addExtension('inject', new \Nette\DI\Extensions\InjectExtension());
			$compiler->loadConfig(asfile('config.neon', $config));
		}
	);

	return new $class;
}

/**
 * @return \ProjectServiceContainer|\Symfony\Component\DependencyInjection\Container
 */
function symfonyFromConfig($config)
{
	$file = TEMP_DIR . '/container.php';

	$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
	$container->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AutowirePass());

	$loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($container, new \Symfony\Component\Config\FileLocator(TEMP_DIR));
	$loader->load(asfile('config.yml', $config));

	$container->compile();

	$dumper = new \Symfony\Component\DependencyInjection\Dumper\PhpDumper($container);
	file_put_contents($file, $dumper->dump());

	require_once $file;

	return new ProjectServiceContainer();
}
