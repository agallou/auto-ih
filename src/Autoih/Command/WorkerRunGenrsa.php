<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;


class WorkerRunGenrsa extends Command
{

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

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $path     = $input->getArgument('path');
    $incoming = $path . '/incoming';
    if (!is_readable($incoming))
    {
      mkdir($incoming);
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
    exec(sprintf('Y:\2012.exe %s', escapeshellarg(str_replace('/', '\\', $currentPathId))));
    $ok = $path . '/ok';
    if (!is_readable($ok))
    {
      mkdir($ok);
    }
    rename($currentPathId, $ok . DIRECTORY_SEPARATOR . $id);
  }

}
