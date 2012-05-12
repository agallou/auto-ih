<?php
namespace Autoih\Provider\Controller;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

use Autoih\Mat2a\Parser;

class ParserController implements ControllerProviderInterface
{

  protected $parserDefinition;

  /**
   * __construct
   *
   * @param mixed $parserDefinition
   */
  public function __construct($parserDefinition)
  {
    $this->parserDefinition = $parserDefinition;
  }

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
    $parserDefinition = $this->parserDefinition;

    $controllers->post('/parse', function () use ($app, $parserDefinition) {

      $file = $app['request']->files->get('export_epmsi');
      if (null === $file)
      {
        throw new \RuntimeException('Fichier exporté de e-PMSI  manquant', 1);
      }

      $parser  = new Parser($parserDefinition);
      $content = $parser->parse($file->getRealPath());
      $status  = 0;
      $message = 'OK';
      $infos = array('status' => $status, 'message' => $message, 'content' => $content);
      return json_encode($infos);
    });

    return $controllers;
  }

}
