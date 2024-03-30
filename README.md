# cpm-formbuilder

## Setup

Erstelle eine .env Datei im Root verzeichnes

<details><summary>Example .env</summary>

```
SOURCE_PATH=/src
VENDOR_PATH=/vendor
PUBLIC_PATH=/public
APP_URL=http://localhost
```
</details>

### Routen ertsllen 
<details><summary>Example Routes</summary>

```php
use App\core\Router;
$router = new Router($_ENV['APP_URL']);

// BEISPIEL ROUTE
// ... SO VIELE ROUTEN ANLEGEN WIE GEWÜNSCHT

$router->addRoute('GET', '/', function () {
    echo 'Home';
});

// ZUTEILUNG
$router->dispatch();

```
</details>