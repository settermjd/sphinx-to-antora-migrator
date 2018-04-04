<?php

$phar = new Phar('converter.phar', 0, 'converter.phar');

// add all files in the project
$phar->buildFromDirectory(dirname(__FILE__) . '/.');
$phar->setStub($phar->createDefaultStub('bin/console.php'));
