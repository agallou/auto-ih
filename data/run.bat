@echo off
:start
"C:\Program Files\PHP\php.exe" bin/auto-ih worker:run-genrsa X:
ping localhost -n 20 -w 1000 > nul
goto start
