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
      'worker:run-genrsa' => $config['worker_genrsa_dir'],
      'worker:run-epmsi'  => $config['worker_epmsi_dir'],
    );
    foreach ($commands as $name => $path)
    {
      $output->writeln(sprintf('<comment>%s</comment>', $name));

      $command = $this->getApplication()->find($name);

      $arguments = array(
        'command' => $name,
        'path'    => $path,
      );

      $input = new ArrayInput($arguments);
      $returnCode = $command->run($input, $output);
    }
  }

}
