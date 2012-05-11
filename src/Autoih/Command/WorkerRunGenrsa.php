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
    parent::configure();
    $this
      ->setName('worker:run-genrsa')
      ->setDescription('Execute ')
    ;
  }

  /**
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   * @param string                                            $year
   * @param string                                            $currentPath
   * @param \Symfony\Component\Console\Input\InputInterface   $input
   */
  protected function process(OutputInterface $output, $year, $currentPath, InputInterface $input)
  {
    $config = $this->getApplication()->getConfig();
    $cmd = sprintf(
      '.\bin\genrsa\%s.exe %s %s %s',
      $year,
      escapeshellarg(str_replace('/', '\\', $currentPath)),
      escapeshellarg($config[sprintf('genrsa_%s_path', $year)]),
      escapeshellarg($config['finess'])
    );
    exec($cmd);
    $finder = new Finder();
    $finder->files()->in($config['desktop_path']);
    foreach ($finder as $file)
    {
      rename($file->getRealPath(), $currentPath . DIRECTORY_SEPARATOR . $file->getFilename());
      break;
    }
  }

}
