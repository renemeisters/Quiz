

## Installation unter Windows

### Vorbereitung

Bevor Sie mit der Installation beginnen können, ist es wichtig, dass Sie auf Ihrem PC einen funktionierenden XAMPP Stack am laufen haben. Sollte das nicht der Fall sein, finden Sie im Internet eine Anleitung dazu.



### Installation

Kopieren Sie zuert alle Dateien aus dem Projekt in Ihren Installations Ordner. Hier wird das Verzeichnis `C:\project\quiz` verwendet.

Um später mit einem DNS Namen auf die Seite zugreifen zu können, müssen Sie den gewünschten DNS Namen in der `hosts`-Datei eintagen. Wir verwenden in diesem Beispiel den Namen `quiz.local`.

`C:\Windows\System32\drivers\etc\hosts`
```
# [...]

127.0.0.1    quiz.local
```

Damit der Apache Webserver aus dem XAMPP Stack weiss, welcher DNS Namen zu welchem Ordner auf dem Dateisystem gehört, müssen einen VirtualHost erstellen. Dazu müssen Sie die Datei `C:\xampp\apache\conf\extra\httpd-vhosts.conf` folgendermassen anpassen.

```apache
# [...]

# Wird benötigt um VirtualHosts für alle Requests auf Port 80 zu aktivieren
NameVirtualHost *:80

# [...]

# Eigentliche VHost Konfiguration
<VirtualHost 127.0.0.1>
    # DNS Name auf den der VHost hören soll
    ServerName quiz.local

    # Ort an dem Das Projekt zu finden ist
    DocumentRoot "c:/project/quiz/public"

    # Nochmals
    <Directory "c:/project/quiz/public">
        Options Indexes FollowSymLinks
        Options +Includes
        AllowOverride All
        Order allow,deny
        Require all granted
        Allow from All
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```
### Datenbank auf Localhost

Nun starten Sie den  und MySQL über das XAMPP Control Panel neu und öffnen Sie die Seite `http://quiz.local/phpmyadmin`.
Klicken Sie links bei den Datenbanken auf "neu", geben Sie der Datenbank den Namen "quiz" und klicken Sie auf anlegen.
Klicken Sie in der Navigation auf "importieren" und wählen Sie die Datei quiz.sql aus, welche Sie im Ordner Data finden.
Klicken Sie nun ohne weitereszu ändern auf Ok und die Datenbank steht.


### Starten
Sie sollten mit dem Browser deines Vertrauens auf die Seite `http://quiz.local` zugreifen können.
