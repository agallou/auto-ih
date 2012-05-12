<?php
namespace Autoih\Mat2a\ParserDefinition;

class Mat2aHad
{

  public function getDefinition()
  {
    return array(
      '01b_tot2' => array(
        'coeff_geo'     => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[1]/td[2]",
        'nb_jours_valo' => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[2]/td[2]",
        'valo_brute'    => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[3]/td[2]",
        'valo_corrigee' => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[4]/td[2]",
        'valo_ehpa'     => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[5]/td[2]",
        'valo_am'       => "//table[@summary='Procedure Print: Data Set WORK.TOT2']/tbody/tr[6]/td[2]",
      ),
      '01d_synthano' => array(
        'nb_total_sejours'          => "//table[@summary='Procedure Print: Data Set WORK.SYNTHANO']/tbody/tr[1]/td[2]",
        'sej_sans_clef'             => "//table[@summary='Procedure Print: Data Set WORK.SYNTHANO']/tbody/tr[2]/td[2]",
        'nb_readmissions'           => "//table[@summary='Procedure Print: Data Set WORK.SYNTHANO']/tbody/tr[11]/td[2]",
        'nb_readmissions_2j'        => "//table[@summary='Procedure Print: Data Set WORK.SYNTHANO']/tbody/tr[12]/td[2]",
        'delai_median_readmissions' => "//table[@summary='Procedure Print: Data Set WORK.SYNTHANO']/tbody/tr[13]/td[2]",

      ),
    );
  }

}
