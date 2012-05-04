<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;


class WorkerRun extends Command
{

  /**
   * configure
   *
   * @return void
   */
  protected function configure()
  {
    $this
      ->setName('worker:run')
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
    $config = $this->getApplication()->getConfig();
    $commands = array(
      array('name' => 'worker:run-genrsa', 'year' => '2011', 'path' => $config['worker_genrsa_dir']),
      array('name' => 'worker:run-genrsa', 'year' => '2012', 'path' => $config['worker_genrsa_dir']),
      array('name' => 'worker:run-epmsi',  'year' => '2012', 'path' => $config['worker_epmsi_dir']),
    );
    foreach ($commands as $infos)
    {
      $name = $infos['name'];
      $output->writeln(sprintf('<comment>%s</comment> (%s)', $name, $infos['year']));

      $command = $this->getApplication()->find($name);
      $path    = $infos['path'] . DIRECTORY_SEPARATOR . $infos['year'];

      $arguments = array(
        'command' => $name,
        'path'    => $path,
        'year'    => $infos['year'],
      );

      $input = new ArrayInput($arguments);
      $returnCode = $command->run($input, $output);
    }
  }

}