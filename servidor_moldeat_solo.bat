@echo off
title Proyecto Server - Solo Carpeta Proyectto
color 0A

echo ================================================
echo     PROYECTO SERVER - SOLO CARPETA PROYECTO
echo ================================================
echo.

echo 1. Verificando Apache...
netstat -an | findstr :80 >nul 2>&1
if %errorlevel%==0 (
    echo ✓ Apache esta corriendo en puerto 80
) else (
    echo ❌ Apache NO esta corriendo
    echo Iniciando XAMPP...
    start "" "C:\xampp\xampp-control.exe"
    echo.
    echo Inicia Apache y presiona cualquier tecla...
    pause
)

echo.
echo 2. Iniciando servidor PHP en puerto 8080...
echo   Esto servira SOLO la carpeta moldeat
echo.



start /B php -S localhost:8080 -t "C:\xampp\htdocs\moldeat"

echo Esperando 3 segundos para que el servidor inicie...
timeout /t 3 /nobreak

echo.
echo 3. Iniciando ngrok para puerto 8080...
echo.
echo 🌐 TU PROYECTO ESTARA EN LA URL QUE APARECE ABAJO:
echo 📁 Servira SOLO la carpeta moldeat (no todo XAMPP)
echo.
ngrok http 8080

pause
