<?php
require_once '../vendor/.composer/autoload.php';

$app = new Silex\Application();

$app->get('/genrsa/send', function () use ($app) {
  $infos = array('id' => null);
  return json_encode($infos);
});

$app->run();

