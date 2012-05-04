<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;


abstract class BaseWorker extends Command
{

  /**
   * configure
   *
   * @return void
   */
  protected function configure()
  {
    $this
      ->setDefinition(array(
        new InputArgument('year', InputArgument::OPTIONAL, '', null),
        new InputArgument('path', InputArgument::OPTIONAL, '', null),
       ))
    ;
  }

  /**
   * execute
   *
   * @param InputInterface  $input
   * @param OutputInterface $output
   *
   * @return void
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $path     = $input->getArgument('path');
    $year     = $input->getArgument('year');
    $incoming = $path . '/incoming';
    if (!is_readable($incoming))
    {
      mkdir($incoming, 0777, true);
    }
    $finder = new Finder();
    $finder->directories()->in($incoming);
    $currentPath = null;
    $id          = null;
    foreach ($finder as $file)
    {
      $filepath = $file->getPathName();
      if (is_file($filepath . DIRECTORY_SEPARATOR . 'ok'))
      {
        $currentPath = $filepath;
        $id          = $file->getBaseName();
        break;
      }
    }

    if (null === $currentPath)
    {
      $output->writeln('No files to process');
      return;
    }
    $output->writeln(sprintf('<info>Folder to process </info>%s', $filepath));
    $current = $path . '/current';
    if (!is_readable($current))
    {
      mkdir($current);
    }

    $currentPathId = $current . DIRECTORY_SEPARATOR . $id;
    rename($currentPath, $currentPathId);
    $this->process($output, $year, $currentPathId);
    $ok = $path . '/ok';
    if (!is_readable($ok))
    {
      mkdir($ok);
    }
    rename($currentPathId, $ok . DIRECTORY_SEPARATOR . $id);
  }

  /**
   * process
   *
   * @param OutputInterface $output
   * @param int             $year
   * @param string          $currentPath
   *
   * @return void
   */
  abstract protected function process(OutputInterface $output, $year, $currentPath);


}
