#include <Array.au3>
#include <GuiTreeView.au3>
#include "..\selectFolder.au3"


Dim $workingDir = $CmdLine[1]
Dim $genrsaPath = $CmdLine[2]
Dim $finess     = $CmdLine[3]

ProcessClose("PAPRICA.exe");
Run($genrsaPath);

Const $genrsaTitle = "PAPRICA 1.9.5.2";

WinWaitActive($genrsaTitle);

ControlSetText($genrsaTitle, "", "[NAME:cbPeriode]", "Période de Test (M0)");

ControlSetText($genrsaTitle, "", "[NAME:ztPathRpss]", $workingDir  & "/rpss");
ControlSetText($genrsaTitle, "", "[NAME:ztPathEHPA]", $workingDir  & "/ehpa");
ControlSetText($genrsaTitle, "", "[NAME:ztPathAno]", $workingDir  & "/anohosp");


ControlClick($genrsaTitle, "", "[NAME:btImportConvEHPA]")

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

ControlClick("PAPRICA - Contrôle du fichier RPSS", "", "[CLASS:Button; INSTANCE:1]")

WinWaitActive("PAPRICA - Saisie des conventions HAD-EHPA");

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

WinWaitActive("PAPRICA - Saisie des conventions HAD-EHPA");
ControlClick("PAPRICA - Saisie des conventions HAD-EHPA", "", "[NAME:btValidation]")

$newGenrsaTitle = "PAPRICA 1.9.5.2";

WinWaitActive($newGenrsaTitle);
ControlClick($newGenrsaTitle, "", "[NAME:btLant]")


WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

;todo timeout là dessus
ControlClick("PAPRICA - Contrôle du fichier RPSS", "", "[CLASS:Button; INSTANCE:1]")

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

WinWaitActive("PAPRICA - Information")
ControlClick("PAPRICA - Information", "", "[CLASS:Button; INSTANCE:1]")

WinWaitActive($newGenrsaTitle)
ControlClick($newGenrsaTitle, "", "[NAME:btExp]")

WinWaitActive("Rechercher un dossier")
_BFF_SelectFolder($workingDir)

ControlClick("Rechercher un dossier", "", "[CLASS:Button; INSTANCE:2]")

WinWaitActive("Export")
ControlClick("Export", "", "[CLASS:Button; INSTANCE:1]")

ProcessClose("PAPRICA.exe");
Exit(0);
