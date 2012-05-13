<?php

namespace Autoih\Mat2a;

class Parser
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
   * parse
   *
   * @param string $zipFile
   *
   * @return array
   */
  public function parse($zipFile)
  {
    $infos = $this->parserDefinition->getDefinition();

    $files = array();
    $zip = new \ZipArchive();
    $zip->open($zipFile);

    for ($i=0; $i<$zip->numFiles;$i++)
    {
      $stat = $zip->statIndex($i);
      $files[$stat['index']] = $stat['name'];
    }
    $arrayIndexes = array();
    foreach (array_keys($infos) as $arrayname)
    {
      list($table) = explode('_', $arrayname);
      foreach ($files as $index => $file)
      {
        if (strpos($file, $table))
        {
          $arrayIndexes[$arrayname] = $index;
        }
      }
    }
    $content = array();

     libxml_use_internal_errors(true);

    foreach ($infos as $arrayname => $infos)
    {
      if (!isset($arrayIndexes[$arrayname]))
      {
        continue;
      }
      $filecontent = $zip->getFromIndex($arrayIndexes[$arrayname]);

      $domDoc = new \DomDocument();
      $domDoc->loadHTML($filecontent);
      $domXpath = new \DomXpath($domDoc);
      foreach ($infos as $keyname => $xpath)
      {
        $list = $domXpath->query($xpath);
        if (0 === $list->length)
        {
          continue;
        }
        $content[$arrayname][$keyname] = $this->cleanValue($list->item(0)->textContent);
      }
    }
    return $content;
  }

  protected function cleanValue($value)
  {
    $value = str_replace(',', '.', $value);
    $value = trim($value);
    $value = str_replace(' ', '', $value);
    if ('.' === $value)
    {
      $value = null;
    }
    return $value;
  }

}
