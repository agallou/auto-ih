<?php
namespace Autoih\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class BaseController implements ControllerProviderInterface
{

  /**
   * year
   *
   * @var int
   */
  protected $year;

  /**
   * __construct
   *
   * @param int $year
   *
   * @return void
   */
  public function __construct($year)
  {
    $this->year = $year;
  }

  /**
   * getWorkingDir
   *
   * @param Application $app

   * @return string
   */
  abstract public function getWorkingDir(Application $app);


  /**
   * manageUpdatedFiles
   *
   * @param Application $app
   * @param string      $dir
   *
   * @return void
   */
  abstract public function manageUpdatedFiles(Application $app, $dir);


  /**
   * getFile
   *
   * @param string $okDir
   * @param string $type

   * @return string
   */
  abstract public function getFile($okDir, $type);

  /**
   * connect
   *
   * @param Application $app

   * @return ControllerCollection
   */
  public function connect(Application $app)
  {
    $controllers = new ControllerCollection();
    $controller  = $this;

    $controllers->post(sprintf('/%s/M0/send', $this->getYear()), function () use ($controller, $app) {

      $incoming = $controller->getWorkingDir($app) . '/incoming';
      if (!is_readable($incoming))
      {
        mkdir($incoming);
      }

      $id  = md5(microtime());

      $dir = $incoming . DIRECTORY_SEPARATOR . $id;
      mkdir($dir);

      $status  = 0;
      $message = 'OK';
      $content = array();

      try
      {
        $controller->manageUpdatedFiles($app, $dir);
        $content = array('id' => $id);
        file_put_contents($dir . DIRECTORY_SEPARATOR . 'ok', '');
      }
      catch (Exception $e)
      {
        rmdir($dir);
        $status = $e->getCode();
        $message = $e->getMessage();
      }

      $infos = array('status' => $status, 'message' => $message, 'content' => $content);
      return json_encode($infos);
    });

    $controllers->get(sprintf('/%s/M0/{id}/status', $this->getYear()), function ($id) use ($controller, $app) {
      $status  = 0;
      $message = 'OK';
      $content = array();

      $folders = array(
        'ok'       => 'SUCCESS',
        'incoming' => 'WAITING',
        'current'  => 'RUNNING',
        'not_ok'   => 'ERROR',
      );
      $genrsaStatus  = null;
      foreach (array_keys($folders) as $folder)
      {
        $dir = $controller->getWorkingDir($app)  . '/' .$folder . '/' . $id;
        if (is_readable($dir))
        {
          $genrsaStatus = $folders[$folder];
        }
      }
      $content['status'] = $genrsaStatus;

      $infos = array('status' => $status, 'message' => $message, 'content' => $content);
      return json_encode($infos);
    });

    $controllers->get(sprintf('/%s/M0/{id}/file/{type}', $this->getYear()), function ($id) use ($controller, $app) {

      $okDir = $controller->getWorkingDir($app) . '/ok/' . $id;
      $file  = $controller->getFile($okDir, null);

      if (null !== $file)
      {
        return file_get_contents($file);
      }

      return null;
    });


    return $controllers;
  }

  /**
   * getYear
   *
   * @return int
   */
  protected function getYear()
  {
    return $this->year;
  }

}

