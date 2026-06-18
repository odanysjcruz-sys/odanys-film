@echo off
title Odanys Media — Share via Cloudflare
color 0B
cls

echo.
echo  ================================================
echo   ODANYS MEDIA — Cloudflare Public Share
echo  ================================================
echo.

:: Kill any leftover cloudflared or ngrok processes
taskkill /f /im cloudflared.exe >nul 2>&1
taskkill /f /im ngrok.exe       >nul 2>&1
timeout /t 1 /nobreak >nul

:: Start Laravel if not already running on 8000
netstat -ano | findstr ":8000" | findstr "LISTENING" >nul 2>&1
if %errorlevel%==0 (
    echo  [OK] Laravel already running on port 8000
) else (
    echo  [..] Starting Laravel on port 8000...
    start "Laravel" /min cmd /c "cd /d %~dp0 && php artisan serve"
    timeout /t 3 /nobreak >nul
    echo  [OK] Laravel started
)

:: Start cloudflared tunnel, write log to temp
echo  [..] Opening Cloudflare tunnel...
set LOGFILE=%TEMP%\cloudflared-odanys.log
if exist "%LOGFILE%" del "%LOGFILE%"

start "" /b "C:\laragon\bin\cloudflared\cloudflared.exe" tunnel --url http://localhost:8000 --logfile "%LOGFILE%"

:: Wait for the URL to appear in the log (up to 15 seconds)
set PUBLIC_URL=
set /a TRIES=0
:WAIT_LOOP
timeout /t 2 /nobreak >nul
set /a TRIES+=1
for /f "delims=" %%L in ('powershell -Command "if (Test-Path '%LOGFILE%') { (Get-Content '%LOGFILE%' -Raw) -match 'https://[a-z0-9-]+\.trycloudflare\.com' | Out-Null; $matches[0] }"') do set PUBLIC_URL=%%L
if defined PUBLIC_URL goto SHOW_URL
if %TRIES% LSS 8 goto WAIT_LOOP

echo  [!!] Could not read URL automatically.
echo       Check the cloudflared window or %LOGFILE%
goto END

:SHOW_URL
echo.
echo  ================================================
echo.
echo   Your public URL:
echo.
echo     %PUBLIC_URL%
echo.
echo   Share this link — no bandwidth limits.
echo   Active while this window stays open.
echo.
echo  ================================================
echo.

:: Open in default browser
start "" "%PUBLIC_URL%"

:END
echo  Press any key to STOP sharing and close the tunnel.
pause >nul

taskkill /f /im cloudflared.exe >nul 2>&1
echo  Tunnel closed. Goodbye.
timeout /t 2 /nobreak >nul
