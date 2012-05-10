<?php
namespace Autoih\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Finder\Finder;


class PapricaController extends BaseController
{

  /**
   * getWorkingDir
   *
   * @param Application $app

   * @return string
   */
  public function getWorkingDir(Application $app)
  {
    return $app['config']['paprica_working_dir'] . DIRECTORY_SEPARATOR . $this->getYear();
  }

  /**
   * manageUpdatedFiles
   *
   * @param Application $app
   * @param string      $dir
   *
   * @return void
   */
  public function manageUpdatedFiles(Application $app, $dir)
  {
    $file = $app['request']->files->get('rpss');
    if (null === $file)
    {
      throw new \RuntimeException('Fichier RPSS manquant', 1);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'rpss');

    $file = $app['request']->files->get('ehpa');
    if (null === $file)
    {
      throw new \RuntimeException('Fichier de conventions manquant', 2);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'ehpa');

    $file = $app['request']->files->get('anohosp');
    if (null === $file)
    {
      throw new \RuntimeException('Fichier anohosp manquant', 3);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'anohosp');
  }

  /**
   * getFile
   *
   * @param string $okDir
   * @param string $type
   *
   * @return string|null
   */
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

