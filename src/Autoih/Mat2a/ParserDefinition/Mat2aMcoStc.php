<?php
namespace Autoih\Mat2a\ParserDefinition;

class Mat2aMcoStc
{

  public function getDefinition()
  {
    return array(
      '34_a' => array(
        'nb_sej-transmis'                => "//table[@summary='Procedure Print: Data Set WORK.TOT']/tbody/tr[1]/td[2]",
        'montant_br-sej_transmis'        => "//table[@summary='Procedure Print: Data Set WORK.TOT']/tbody/tr[1]/td[3]",
        'nb_sej-non_fact_am_hors_po'     => "//table[@summary='Procedure Print: Data Set WORK.TOT']/tbody/tr[8]/td[2]",
        'montant_br-non_fact_am_hors_po' => "//table[@summary='Procedure Print: Data Set WORK.TOT']/tbody/tr[8]/td[3]",
      ),
      '34_c' => array(
        'br_tot-coeff_geo'                  => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[1]/td[4]",
        'br_tot-coeff_trans'                => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[2]/td[4]",
        'br_tot-valo_ghs'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[3]/td[4]",
        'br_tot-valo_exb'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[4]/td[4]",
        'br_tot-valo_sej_rehosp_meme_ghm'   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[5]/td[4]",
        'br_tot-valo_exh'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[6]/td[4]",
        'br_tot-valo_actes_ghs_9615_hospit' => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[7]/td[4]",
        'br_tot-valo_suppl_radoth_pedia'    => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[8]/td[4]",
        'br_tot-valo_suppl_antepartum'      => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[9]/td[4]",
        'br_tot-valo_actes_rdth_hospit'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[10]/td[4]",
        'br_tot-valo_suppl_rea'             => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[11]/td[4]",
        'br_tot-valo_suppl_rea_pedia'       => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[12]/td[4]",
        'br_tot-valo_suppl_neo_sans_si'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[13]/td[4]",
        'br_tot-valo_suppl_neo_avec_si'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[14]/td[4]",
        'br_tot-valo_suppl_rea_neo'         => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[15]/td[4]",
        'br_tot-valo_po'                    => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[16]/td[4]",
        'br_tot-valo_actes_caiss_hype_sus'  => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[17]/td[4]",
        'br_tot-valo_suppl_dial'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[18]/td[4]",
        'br_tot-valo_sc_valides'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[19]/td[4]",
        'br_tot-valo_si_valides'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[20]/td[4]",
        'br_tot-total_valo'                 => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[21]/td[4]",

        'am-coeff_geo'                  => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[1]/td[6]",
        'am-coeff_trans'                => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[2]/td[6]",
        'am-valo_ghs'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[3]/td[6]",
        'am-valo_exb'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[4]/td[6]",
        'am-valo_sej_rehosp_meme_ghm'   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[5]/td[6]",
        'am-valo_exh'                   => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[6]/td[6]",
        'am-valo_actes_ghs_9615_hospit' => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[7]/td[6]",
        'am-valo_suppl_radoth_pedia'    => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[8]/td[6]",
        'am-valo_suppl_antepartum'      => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[9]/td[6]",
        'am-valo_actes_rdth_hospit'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[10]/td[6]",
        'am-valo_suppl_rea'             => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[11]/td[6]",
        'am-valo_suppl_rea_pedia'       => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[12]/td[6]",
        'am-valo_suppl_neo_sans_si'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[13]/td[6]",
        'am-valo_suppl_neo_avec_si'     => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[14]/td[6]",
        'am-valo_suppl_rea_neo'         => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[15]/td[6]",
        'am-valo_po'                    => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[16]/td[6]",
        'am-valo_actes_caiss_hype_sus'  => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[17]/td[6]",
        'am-valo_suppl_dial'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[18]/td[6]",
        'am-valo_sc_valides'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[19]/td[6]",
        'am-valo_si_valides'            => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[20]/td[6]",
        'am-total_valo'                 => "//table[@summary='Procedure Print: Data Set WORK.S2TTB']/tbody/tr[21]/td[6]",
      ),
    );
  }

}
