<?php
/**
 * Created by PhpStorm.
 * User: Benjamin-ut
 * Date: 07/01/2015
 * Time: 12:23
 */



require __DIR__.'/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [
    "src",
];

$isDevMode = true;

// the connection configuration
$dbParams = include __DIR__.'/config/config.php';

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
return EntityManager::create($dbParams, $config);