<?php
$loader = require_once '../vendor/.composer/autoload.php';
$loader->add('Autoih', 'src');

$config        = new Autoih\Config\Config;
$app           = new Silex\Application();
$app['config'] = $config->load(__DIR__ . '/../config/configuration.yml');

$app->mount('/genrsa', new Autoih\Provider\Controller\GenrsaController());
$app->mount('/epmsi', new Autoih\Provider\Controller\EpmsiController());

$app->run();

