<?php
$loader = require_once '../vendor/.composer/autoload.php';
$loader->add('Autoih', 'src');

$app = new Silex\Application();

$config = new Pimple();
$config['genrsa_working_dir'] = '/media/autoih_worker/genrsa/';
$config['epmsi_working_dir']  = '/media/autoih_worker/epmsi/';


$app['config'] = $config;
$app['debug']  = true;

$app->mount('/genrsa', new Autoih\Provider\Controller\GenrsaController());
$app->mount('/epmsi', new Autoih\Provider\Controller\EpmsiController());

$app->run();

