@echo off
:start
"C:\Program Files\PHP\php.exe" .\bin\auto-ih worker:run-genrsa X:\genrsa
"C:\Program Files\PHP\php.exe" .\bin\auto-ih worker:run-epmsi X:\epmsi
ping localhost -n 20 -w 1000 > nul
goto start
