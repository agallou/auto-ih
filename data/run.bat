@echo off
:start
"C:\Program Files\PHP\php.exe" .\bin\auto-ih worker:run
ping localhost -n 20 -w 1000 > nul
goto start
