<?php
namespace Autoih\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Finder\Finder;

abstract class Mat2aController extends BaseController
{

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
    $finder->files()->name('export_epmsi.zip')->in($okDir);
    if (count($finder) == 1)
    {
      $files = array_values(iterator_to_array($finder));
      return $files[0];
    }
    return null;
  }

}

