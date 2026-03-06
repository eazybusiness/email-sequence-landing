# IONOS Deployment Anleitung

## Server-Details

- **Server:** home30227715.1and1-data.host
- **Benutzer:** p7872929
- **Ziel-Ordner:** ~/tmp/email

## Deployment-Schritte

### Option 1: Automatisches Deployment-Skript

```bash
cd /home/nop/CascadeProjects/email_sequence
./deploy-to-ionos.sh
```

Das Skript wird nach dem Passwort fragen und dann alle Dateien hochladen.

### Option 2: Manueller Upload via rsync

```bash
rsync -avz --progress public/ p7872929@home30227715.1and1-data.host:~/tmp/email/
```

### Option 3: Manueller Upload via SCP

```bash
scp -r public/* p7872929@home30227715.1and1-data.host:~/tmp/email/
```

## Nach dem Upload

### 1. Per SSH verbinden

```bash
ssh p7872929@home30227715.1and1-data.host
```

### 2. Dateien überprüfen

```bash
cd ~/tmp/email
ls -la
```

### 3. PHP-Dateien ausführbar machen

```bash
chmod 755 api/*.php
chmod 644 api/config.php
```

### 4. Logs-Ordner erstellen

```bash
mkdir -p logs
chmod 755 logs
```

### 5. Brevo List ID konfigurieren

Bearbeiten Sie `api/config.php` und tragen Sie die korrekte Brevo List ID ein:

```php
define('BREVO_LIST_ID', 2); // Ersetzen Sie 2 mit Ihrer tatsächlichen List ID
```

## Brevo Kontaktliste erstellen

1. Login: https://app.brevo.com/
2. Gehen Sie zu: **Contacts** → **Lists**
3. Klicken Sie auf: **Create a list**
4. Name: `Team Mehrwert - Landing Page Signups`
5. Notieren Sie die **List ID** (wird in der URL angezeigt)
6. Tragen Sie die List ID in `api/config.php` ein

## Brevo Attribute erstellen

Gehen Sie zu: **Contacts** → **Settings** → **Contact attributes**

Erstellen Sie folgende Attribute:

| Attribut | Typ | Beschreibung |
|----------|-----|--------------|
| FIRSTNAME | Text | Vorname |
| LASTNAME | Text | Nachname |
| SMS | Text | Mobilfunknummer |
| MENTOR | Text | Mentor Name |
| SIGNUP_DATE | Date | Anmeldedatum |

## URL testen

Nach dem Deployment sollte die Seite erreichbar sein unter:

```
http://[ihre-domain]/tmp/email/
```

Oder direkt über IONOS:
```
http://home30227715.1and1-data.host/~p7872929/tmp/email/
```

## Formular testen

1. Öffnen Sie die URL im Browser
2. Füllen Sie das Formular aus
3. Klicken Sie auf "Anmelden"
4. Überprüfen Sie in Brevo, ob der Kontakt angelegt wurde

## Fehlersuche

### PHP-Fehler anzeigen

```bash
tail -f logs/php-errors.log
```

### Apache-Fehlerlog

```bash
tail -f /var/log/apache2/error.log
```

### Brevo API testen

```bash
curl -X POST https://api.brevo.com/v3/contacts \
  -H "api-key: YOUR_BREVO_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "attributes": {
      "FIRSTNAME": "Test",
      "LASTNAME": "User"
    },
    "listIds": [2]
  }'
```

## Wichtige Hinweise

- ⚠️ Die Datei `api/config.php` enthält den Brevo API Key und sollte NICHT öffentlich zugänglich sein
- ⚠️ Stellen Sie sicher, dass PHP auf dem Server aktiviert ist
- ⚠️ IONOS Shared Hosting unterstützt PHP - GitHub Pages NICHT
- ⚠️ Die GitHub Pages Version (https://eazybusiness.github.io/email-sequence-landing/) ist nur für Design-Vorschau, das Formular funktioniert dort NICHT

## Produktiv-Deployment (später)

Wenn der Kunde seinen IONOS Account bereitstellt:

1. Dateien in das Document Root verschieben (z.B. `/htdocs/`)
2. Domain konfigurieren: `teammehrwert.info`
3. SSL-Zertifikat aktivieren (Let's Encrypt via IONOS)
4. `.htaccess` für HTTPS-Redirect erstellen

## Support

Bei Problemen:
- Brevo Support: https://help.brevo.com/
- IONOS Support: https://www.ionos.de/hilfe/
