<?php
require_once '../vendor/.composer/autoload.php';

$app = new Silex\Application();

$config = new Pimple();
$config['working_dir']  = '/media/autoih_worker';
$config['incoming_dir'] = '/media/autoih_worker/incoming';


$app['config'] = $config;

$app['debug'] = true;

$app->post('/genrsa/2012/send', function () use ($app) {

  if (!is_readable($app['config']['incoming_dir']))
  {
    mkdir($app['config']['incoming_dir']);
  }

  $id  = md5(microtime());

  $dir = $app['config']['incoming_dir'] . DIRECTORY_SEPARATOR . $id;
  mkdir($dir);

  $status  = 0;
  $message = 'OK';
  $content = array();

  try
  {
    $file = $app['request']->files->get('rss');
    if (null === $file)
    {
      throw new RuntimeException('Fichier RSS manquant', 1);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'rss');

    $file = $app['request']->files->get('autorisations');
    if (null === $file)
    {
      throw new RuntimeException('Fichier autorisations manquant', 2);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'autorisations');

    $file = $app['request']->files->get('anohosp');
    if (null === $file)
    {
      throw new RuntimeException('Fichier anohosp manquant', 3);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'anohosp');
    $content = array('id' => $id);

    file_put_contents($dir . DIRECTORY_SEPARATOR . 'ok', '');
  }
  catch (Exception $e)
  {
    $status = $e->getCode();
    $message = $e->getMessage();
  }

  $infos = array('status' => $status, 'message' => $message, 'content' => $content);
  return json_encode($infos);
});

$app->post('/genrsa/2012/{id}/status', function ($id) use ($app) {
  $status  = 0;
  $message = 'OK';
  $content = array();

  $infos = array('status' => $status, 'message' => $message, 'content' => $content);
  return json_encode($infos);
});

$app->post('/genrsa/2012/{id}/file/{type}', function ($id) use ($app) {
  $status  = 0;
  $message = 'OK';
  $content = array();

  $infos = array('status' => $status, 'message' => $message, 'content' => $content);
  return json_encode($infos);
});


$app->run();

