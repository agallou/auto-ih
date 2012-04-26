<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;


class WorkerRunGenrsa extends BaseWorker
{

  /**
   * configure
   *
   * @return void
   */
  protected function configure()
  {
    $this
      ->setName('worker:run-genrsa')
      ->setDescription('Execute ')
      ->setDefinition(array(
        new InputArgument('path', InputArgument::OPTIONAL, '', null),
       ))
    ;
  }

  /**
   * process
   *
   * @param OutputInterface $output
   * @param string          $currentPath
   *
   * @return void
   */
  protected function process(OutputInterface $output, $currentPath)
  {
    exec(sprintf('.\bin\genrsa\2012.exe %s', escapeshellarg(str_replace('/', '\\', $currentPath))));
  }

}