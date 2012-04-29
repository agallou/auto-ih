<?php

namespace Autoih;

use Symfony\Component\Console\Application as BaseApplication;
use Autoih\Config\Config;

class Application extends BaseApplication
{

  /**
   * config
   *
   * @var Config
   */
  protected $config;

  /**
   * setConfig
   *
   * @param Config $config
   *
   * @return $this
   */
  public function setConfig(Config $config)
  {
    $this->config = $config;

    return $this;
  }

  /**
   * getConfig
   *
   * @return Pimple
   */
  public function getConfig()
  {
    return $this->config;
  }

}
