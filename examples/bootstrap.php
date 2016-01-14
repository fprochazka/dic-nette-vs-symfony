<?php

use Nette\Utils\FileSystem;
use Tracy\Debugger;

require_once __DIR__ . '/../vendor/autoload.php';

define('TEMP_DIR', __DIR__ . '/../tmp/' . basename($_SERVER['SCRIPT_NAME'], '.php') . '/' . getmypid());
FileSystem::createDir(TEMP_DIR);

Debugger::enable(FALSE, __DIR__ . '/../tmp');
Debugger::$strictMode = TRUE;

function asfile($name, $content) {
    file_put_contents($filepath = TEMP_DIR . '/' . $name, $content);
    return $filepath;
}
