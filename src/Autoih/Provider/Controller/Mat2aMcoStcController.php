<?php
namespace Autoih\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Finder\Finder;

class Mat2aMcoStcController extends Mat2aController
{

  /**
   * @param \Silex\Application $app
   * @param string             $dir
   *
   * @throws \RuntimeException
   */
  public function manageUpdatedFiles(Application $app, $dir)
  {
    $file = $app['request']->files->get('export_genrsa');
    if (null === $file)
    {
      throw new \RuntimeException('Fichier ZIP export GENRSA manquant', 1);
    }
    move_uploaded_file($file->getRealPath(), $dir . DIRECTORY_SEPARATOR .  'export_genrsa.zip');
  }

  /**
   * @param \Silex\Application $app
   *
   * @return string
   */
  public function getWorkingDir(Application $app)
  {
    return $app['config']['epmsi_working_dir'] . 'mat2a_mco_stc' . DIRECTORY_SEPARATOR . $this->getYear();
  }

}

