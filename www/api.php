<?php
$loader = require_once '../vendor/.composer/autoload.php';
$loader->add('Autoih', 'src');

$config        = new Autoih\Config\Config;
$app           = new Silex\Application();
$app['config'] = $config->load(__DIR__ . '/../config/configuration.yml');

$app->mount('/genrsa', new Autoih\Provider\Controller\GenrsaController('2012'));
$app->mount('/genrsa', new Autoih\Provider\Controller\GenrsaController('2011'));

$app->mount('/epmsi/mat2a/mco_stc', new Autoih\Provider\Controller\Mat2aMcoStcController('2012'));
$app->mount('/epmsi/mat2a/mco_stc', new Autoih\Provider\Controller\Mat2aMcoStcController('2011'));
$app->mount('/epmsi/mat2a/had', new Autoih\Provider\Controller\Mat2aHadController('2012'));

$app->mount('/paprica', new Autoih\Provider\Controller\PapricaController('2012'));

$app->mount('/epmsi/mat2a/had/2012/M0', new Autoih\Provider\Controller\ParserController(new Autoih\Mat2a\ParserDefinition\Mat2aHad(array(2012))));
$app->mount('/epmsi/mat2a/mco_stc/2012/M0', new Autoih\Provider\Controller\ParserController(new Autoih\Mat2a\ParserDefinition\Mat2aMcoStc(array('year' => 2012))));
$app->mount('/epmsi/mat2a/mco_stc/2011/M0', new Autoih\Provider\Controller\ParserController(new Autoih\Mat2a\ParserDefinition\Mat2aMcoStc(array('year' => 2011))));


$app->run();

