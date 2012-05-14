#include <Array.au3>
#include <GuiTreeView.au3>

Dim $workingDir = $CmdLine[1]
Dim $genrsaPath = $CmdLine[2]
Dim $finess     = $CmdLine[3]

ProcessClose("PAPRICA.exe");
Run($genrsaPath);

Const $genrsaTitle = "PAPRICA 1.9.5.2";

WinWaitActive($genrsaTitle);

ControlCommand($genrsaTitle, "", "[NAME:cbPeriode]", "SelectString", "Période de Test (M0) ")
ControlSetText($genrsaTitle, "", "[NAME:cbPeriode]", "Période de Test (M0)")

ControlSetText($genrsaTitle, "", "[NAME:ztPathRpss]", $workingDir  & "\rpss");
ControlSetText($genrsaTitle, "", "[NAME:ztPathEHPA]", $workingDir  & "\ehpa");
ControlSetText($genrsaTitle, "", "[NAME:ztPathAno]", $workingDir  & "\anohosp");


ControlClick($genrsaTitle, "", "[NAME:btImportConvEHPA]")

While True
   If WinExists("[CLASS:Notepad]") And WinExists("PAPRICA - Contrôle du fichier RPSS") Then
	  WinWaitActive("[CLASS:Notepad]")
	  WinClose("[CLASS:Notepad]")
	  WinWaitActive("PAPRICA - Contrôle du fichier RPSS")
	  ControlClick("PAPRICA - Contrôle du fichier RPSS", "", "[CLASS:Button; INSTANCE:1]")
	  WinWaitActive("[CLASS:Notepad]")
	  WinClose("[CLASS:Notepad]")
	  WinWaitActive("PAPRICA - Saisie des conventions HAD-EHPA")
	  ControlClick("PAPRICA - Saisie des conventions HAD-EHPA", "", "[NAME:btValidation]")
	  ExitLoop
   EndIf
   If WinExists("PAPRICA - Saisie des conventions HAD-EHPA") Then
	  WinWaitActive("[CLASS:Notepad]")
	  WinClose("[CLASS:Notepad]")
	  WinWaitActive("PAPRICA - Saisie des conventions HAD-EHPA")
	  ControlClick("PAPRICA - Saisie des conventions HAD-EHPA", "", "[NAME:btValidation]")
	  ExitLoop
   EndIf
WEnd

$newGenrsaTitle = "PAPRICA 1.9.5.2";

   
WinWaitActive($newGenrsaTitle)
ControlClick($newGenrsaTitle, "", "[NAME:btLant]")


While True
   If WinExists("PAPRICA - Contrôle du fichier RPSS") Then
	  WinActivate("PAPRICA - Contrôle du fichier RPSS")
	  ControlClick("PAPRICA - Contrôle du fichier RPSS", "", "[CLASS:Button; INSTANCE:1]")
   EndIf
   If WinExists("[CLASS:Notepad]") Then
	  WinActivate("[CLASS:Notepad]")
	  WinClose("[CLASS:Notepad]")
   EndIf
   If WinExists("PAPRICA - Information") Then
	  ExitLoop
   EndIf
WEnd


WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

WinWaitActive("[CLASS:Notepad]")
WinClose("[CLASS:Notepad]")

WinWaitActive("PAPRICA - Information")
ControlClick("PAPRICA - Information", "", "[CLASS:Button; INSTANCE:1]")   

WinWaitActive($newGenrsaTitle)
ControlClick($newGenrsaTitle, "", "[NAME:btExp]")

if @OSLang == '040C' Then
  Dim $browseFolderTitle = 'Rechercher un dossier'
  Else
  Dim $browseFolderTitle = 'Browse For Folder'
EndIf


; le fichier exporté sera placé sur le bureau
WinWaitActive($browseFolderTitle)
ControlClick($browseFolderTitle, "", "[CLASS:Button; INSTANCE:2]")

WinWaitActive("Export")
ControlClick("Export", "", "[CLASS:Button; INSTANCE:1]")

ProcessClose("PAPRICA.exe");
Exit(0);
