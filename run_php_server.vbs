Set WshShell = CreateObject("WScript.Shell")
WshShell.Run "cmd /c cd /d C:\xampp\htdocs\www && php artisan serve", 0
