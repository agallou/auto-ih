<?php
namespace Autoih\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;


class WorkerRunEpmsi extends BaseWorker
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
      ->setName('worker:run-epmsi')
      ->setDescription('Execute ')
    ;
    $this->getDefinition()->addArgument(new InputArgument('field', InputArgument::REQUIRED));
  }

  /**
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   * @param string                                            $year
   * @param string                                            $currentPath
   * @param \Symfony\Component\Console\Input\InputInterface   $input
   *
   * @throws \RuntimeException
   */
  protected function process(OutputInterface $output, $year, $currentPath, InputInterface $input)
  {
    $config = $this->getApplication()->getConfig();
    $field = $input->getArgument('field');

    $fileEpmsiSahi = $config['sahi_userdata'] . '/export_epmsi.zip';
    $fileGenrsaSahi= $config['sahi_userdata'] . '/' . $this->getInfo($field, $year, 'import_file');

    if (is_file($fileEpmsiSahi))
    {
      unlink($fileEpmsiSahi);
    }

    if (is_file($fileGenrsaSahi))
    {
      unlink($fileGenrsaSahi);
    }

    $fileEpmsi = $currentPath .'/export_epmsi.zip';
    copy($currentPath .'/' . $this->getInfo($field, $year, 'import_file'), $fileGenrsaSahi);

    $connection = new \Behat\SahiClient\Connection(null, $config['sahi_host'], 9999, null, 24000);
    $client     = new \Behat\SahiClient\Client($connection);
    $client->start('firefox');
    $url = 'https://www.epmsi.atih.sante.fr';
    $client->navigateTo($url);
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[2]/td[@class='epmsimenu0']/a")->click();

    $client->findTextbox('username')->setValue($config['epmsi_user']);
    $client->findById('password')->setValue($config['epmsi_password']);
    $client->findByXPath("//div[@id='login' and @class='box']/div[4][@class='row btn-row']/input[3][@class='btn-submit']")->click();

    //clic sur Applications
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[3]/td[@class='epmsimenu0']/a")->click();

    //clic sur MaT2a
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[4]/td[@class='epmsimenu1']/a")->click();

    //clic sur MaT2a MCO DGF sans taux de conversion
    $client->findByXPath($this->getInfo($field, $year, 'field'))->click();

    //année 2012, période de test (M0), Fichiers
    $client->findByXPath($this->getInfo($field, $year, 'periode_fichiers'))->click();

    //Transmettre ANO, RSA...
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/table[1][@class='tabcolor']/tbody/tr[2]/td[5][@class='tabbodycnt']/a/b")->click();

    //selection du fichier
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/form/table[1]/tbody/tr[4]/td/input")->setFile($this->getInfo($field, $year, 'import_file'));

    //click sur Envoyer
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/form/table[2]/tbody/tr/td/input")->click();

    //click sur traitement
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[7]/td[@class='epmsimenu3']/a")->click();

    //On coche la case
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/form/table[1][@class='tabcolor']/tbody/tr[2]/td[6][@class='tabbodycnt']/input")->check();

    //clic sur commander
    $client->findByXPath("//input[@type='submit']")->click();

    //on vérifie l'état du traitement
    $running = true;

    while ($running)
    {
      sleep(5);

      //click sur traitement
      $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[7]/td[@class='epmsimenu3']/a")->click();

      $text = null;
      try
      {
        $text = $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/form/table[1][@class='tabcolor']/tbody/tr[2]/td[4][@class='tabbodycnt']/b")->getText();
      }

      catch (\Behat\SahiClient\Exception\ConnectionException $e)
      {
      }
      $running = ($text !== 'Traitement réussi');
    }

    //clic sur résulats
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[1]/table/tbody/tr[10]/td[@class='epmsimenu3']/a")->click();

    //clic sur Télécharger les résultats (un fichier zip contenant des *.html)
    $client->findByXPath("/html/body/table[2]/tbody/tr/td[3]/font/table[1][@class='tabcolor']/tbody/tr/td[1][@class='tabbody']/a[2]")->click();
    sleep(5);

    $connection->executeStep(sprintf("_sahi._saveDownloadedAs('%s')", 'export_epmsi.zip')); // save to another path

    $client->stop();
    copy($fileEpmsiSahi, $fileEpmsi);
    unlink($fileEpmsiSahi);
    unlink($fileGenrsaSahi);
  }

  /**
   * @param string $field
   * @param string $year
   * @param string $type
   *
   * @return string
   */
  protected function getInfo($field, $year, $type)
  {
    $xpaths = array(
      'mat2a_mco_stc' => array(
        'field'            => "/html/body/table[2]/tbody/tr/td[3]/font/ul[1]/li[2]/a",
        'import_file'      => 'export_genrsa.zip',
        'periode_fichiers' => array(
          '2012' => "//li[@id='li97']/ul/li[1]/a",
          '2011' => "//li[@id='li202']/ul/li[1]/a",
        ),
      ),
      'mat2a_had' => array(
        'field'            => "/html/body/table[2]/tbody/tr/td[3]/font/ul[2]/li/a",
        'import_file'      => 'export_paprica.zip',
        'periode_fichiers' => array(
          '2012' => "//li[@id='li97']/ul/li[1]/a",
          '2011' => "//li[@id='li202']/ul/li[1]/a",
        ),
      )
    );
    $info =  $xpaths[$field][$type];
    if (is_array($info))
    {
      $info = $info[$year];
    }
    return $info;
  }

}
