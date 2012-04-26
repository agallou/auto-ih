<?php
namespace Autoih\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EpmsiController extends BaseController
{

  public function getWorkingDir($app)
  {
    return $app['config']['epmsi_working_dir'];
  }

  public function manageUpdatedFiles($app, $dir)
  {
    $file = $app['request']->files->get('export_genrsa');
    if (null === $file)
    {
      throw new RuntimeException('Fichier ZIP export GENRSA manquant', 1);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'export_genrsa.zip');
  }

  public function getFile($okDir, $type)
  {
    $finder = new Finder();
    $finder->files()->name('*.zip')->in($okDir);
    if (count($finder) == 1)
    {
      $files = array_values(iterator_to_array($finder));
      return $files[0];
    }
    return null;
  }

}

