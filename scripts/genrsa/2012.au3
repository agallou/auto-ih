#include <Array.au3>
#include <GuiTreeView.au3>

Dim $workingDir = $CmdLine[1]
Dim $genrsaPath = $CmdLine[2]
Dim $finess     = $CmdLine[3]

ProcessClose("WGENRSA.exe");
Run($genrsaPath);

Const $genrsaTitle = "GENRSA 11.1.1.0";

WinWaitActive($genrsaTitle);

ControlSetText($genrsaTitle, "", "[NAME:comboPeriode]", "Période de test (M0)");

ControlSetText($genrsaTitle, "", "[NAME:ztPathRss]", $workingDir  & "/rss");
ControlSetText($genrsaTitle, "", "[NAME:tbFicUMImport]", $workingDir  & "/autorisations");
ControlSetText($genrsaTitle, "", "[NAME:ztPathAno]", $workingDir  & "/anohosp");

ControlClick($genrsaTitle, "", "[NAME:btTraitChoixUm]")

$umTitle = "Renseignements des données sur les unités médicales";
WinWait($umTitle);
ProcessClose("notepad.exe");

ControlClick($umTitle, "", "[NAME:btValid]");

$newGenrsaTitle = "GENRSA 11.1.0.0  [" & $finess & "]  [Période de test (M0)]  [2012]";

WinWaitActive($newGenrsaTitle);
ControlClick($newGenrsaTitle, "", "[NAME:btLant]")

WinWaitActive("Fin de traitement")
ControlClick("Fin de traitement", "", "[CLASS:Button; INSTANCE:1]")

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")
WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")
ProcessClose("notepad.exe");

WinWaitActive($newGenrsaTitle)
ControlClick($newGenrsaTitle, "", "[NAME:btExp]")

if @OSLang == '040c' Then
  Dim $browseFolderTitle = 'Rechercher un dossier'
  Else
  Dim $browseFolderTitle = 'Browse For Folder'
EndIf

WinWaitActive($browseFolderTitle)
ControlClick($browseFolderTitle, "", "[CLASS:Button; INSTANCE:2]")

WinWaitActive("Export")
ControlClick("Export", "", "[CLASS:Button; INSTANCE:1]")
ProcessClose("WGENRSA.exe");
Exit(0);
