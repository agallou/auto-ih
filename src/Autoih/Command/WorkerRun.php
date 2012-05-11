<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * @method \Autoih\Application getApplication
 */
class WorkerRun extends Command
{

  /**
   *
   */
  protected function configure()
  {
    $this
      ->setName('worker:run')
    ;
  }

  /**
   * @param \Symfony\Component\Console\Input\InputInterface $input
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $config = $this->getApplication()->getConfig();
    $commands = array(
      array('name' => 'worker:run-genrsa', 'year' => '2011', 'path' => $config['worker_genrsa_dir']),
      array('name' => 'worker:run-genrsa', 'year' => '2012', 'path' => $config['worker_genrsa_dir']),
      array('name' => 'worker:run-paprica', 'year' => '2012', 'path' => $config['worker_paprica_dir']),
      array('name' => 'worker:run-epmsi',  'year' => '2012', 'path' => $config['worker_epmsi_dir'], 'field' => 'mat2a_mco_stc'),
      array('name' => 'worker:run-epmsi',  'year' => '2011', 'path' => $config['worker_epmsi_dir'], 'field' => 'mat2a_mco_stc'),
      array('name' => 'worker:run-epmsi',  'year' => '2012', 'path' => $config['worker_epmsi_dir'], 'field' => 'mat2a_had'),
    );
    foreach ($commands as $infos)
    {
      $name          = $infos['name'];
      $displayedName = $name;
      if (isset($infos['field']))
      {
        $displayedName .= ' - ' . $infos['field'];
      }
      $output->writeln(sprintf('<comment>%s</comment> (%s)', $displayedName, $infos['year']));

      $command = $this->getApplication()->find($name);
      $path    = $infos['path'] . DIRECTORY_SEPARATOR . $infos['year'];

      if (isset($infos['field']))
      {
        $path    = $infos['path'] . DIRECTORY_SEPARATOR . $infos['field'] . DIRECTORY_SEPARATOR . $infos['year'];
      }

      $arguments = array(
        'command' => $name,
        'path'    => $path,
        'year'    => $infos['year'],
      );

      if (isset($infos['field']))
      {
        $arguments['field'] = $infos['field'];
      }

      $input = new ArrayInput($arguments);
      $command->run($input, $output);
    }
  }

}
