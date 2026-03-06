# Schnelle Fehlersuche - 500 Internal Server Error

## Problem
Das Formular gibt einen 500 Internal Server Error zurück auf:
`https://temp.hiplus.de/email/api/submit.php`

## Mögliche Ursachen

### 1. **config.php fehlt**
Die Datei `api/config.php` wurde möglicherweise nicht hochgeladen.

**Lösung:**
```bash
ssh p7872929@home30227715.1and1-data.host
cd ~/tmp/email/api
ls -la config.php
```

Wenn die Datei fehlt, erstellen Sie sie:
```bash
nano config.php
```

Inhalt:
```php
<?php
define('BREVO_API_KEY', 'YOUR_BREVO_API_KEY_HERE');
define('BREVO_LIST_ID', 3);
define('BREVO_SENDER_EMAIL', 'Office@teammehrwert.info');
define('BREVO_SENDER_NAME', 'Team Mehrwert');
define('SITE_URL', 'https://temp.hiplus.de/email');
define('ENABLE_DOUBLE_OPT_IN', false);
define('CSRF_TOKEN_NAME', 'csrf_token');
define('RATE_LIMIT_MAX', 3);
define('RATE_LIMIT_WINDOW', 3600);
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/php-errors.log');
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cookie_samesite' => 'Strict'
    ]);
}
?>
```

### 2. **PHP Fehler-Logs prüfen**

```bash
ssh p7872929@home30227715.1and1-data.host
tail -50 ~/tmp/email/logs/php-errors.log
```

Falls der logs-Ordner nicht existiert:
```bash
mkdir -p ~/tmp/email/logs
chmod 755 ~/tmp/email/logs
```

### 3. **PHP Version prüfen**

```bash
ssh p7872929@home30227715.1and1-data.host
php -v
```

Mindestens PHP 7.4 erforderlich.

### 4. **Datei-Berechtigungen prüfen**

```bash
ssh p7872929@home30227715.1and1-data.host
cd ~/tmp/email
chmod 755 api/*.php
chmod 644 api/config.php
```

### 5. **Test-Skript erstellen**

Erstellen Sie `api/test.php`:
```php
<?php
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'PHP is working',
    'php_version' => phpversion(),
    'curl_available' => function_exists('curl_init'),
    'config_exists' => file_exists('config.php')
]);
?>
```

Dann testen:
```
https://temp.hiplus.de/email/api/test.php
```

### 6. **Direkter API-Test**

```bash
curl -X POST https://temp.hiplus.de/email/api/submit.php \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "vorname=Test&name=User&email=test@example.com&mobilfunknummer=01234567890&mentor=TestMentor&privacy=on&marketing=on"
```

## Schnelle Lösung

Wenn alles andere fehlschlägt, deployen Sie erneut:

```bash
cd /home/nop/CascadeProjects/email_sequence
./deploy-to-ionos.sh
```

Dann SSH zum Server:
```bash
ssh p7872929@home30227715.1and1-data.host
cd ~/tmp/email
```

Erstellen Sie `api/config.php` manuell (siehe oben).

Testen Sie dann:
```
https://temp.hiplus.de/email/api/test.php
```

## Debug-Informationen sammeln

Wenn der Fehler weiterhin besteht, sammeln Sie diese Informationen:

1. PHP Version: `php -v`
2. Dateiliste: `ls -la ~/tmp/email/api/`
3. Fehler-Log: `tail -50 ~/tmp/email/logs/php-errors.log`
4. Test-Skript Ausgabe: `curl https://temp.hiplus.de/email/api/test.php`

Teilen Sie diese Informationen mit, um das Problem zu identifizieren.
