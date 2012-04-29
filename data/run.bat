@echo off
REM  example: 
REM  SET PHP_PATH="C:\Program Files\PHP\php.exe" && .\data\run.bat
:start
%PHP_PATH% .\bin\auto-ih worker:run
ping localhost -n 20 -w 1000 > nul
goto start
