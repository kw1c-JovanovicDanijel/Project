## Startup-gids

## Vereisten `*`
- [Laravel Herd](https://herd.laravel.com)
- [PHP versie 8.3.x](https://php.net/downloads) (liefste 8.4.x)`**`
- [Composer](https://getcomposer.org/download)
- [Node.js](https://nodejs.org/en/download)

---
#### `*` Sommige van deze kunnen direct worden gedownload en gebruikt in Laravel Herd. Kies in de instellingen welke code-editor je wilt gebruiken!
##
#### `**` Deze extensies moeten ingeschakeld zijn in je `php.ini` bestand
---

* Ctype
* cURL 
* DOM 
* Fileinfo 
* Filter 
* Hash 
* Mbstring 
* OpenSSL 
* PCRE 
* PDO 
* Session 
* Tokenizer 
* XML 
* SQLite
---
### *DISCLAIMER!* Ik gebruik Git Bash in VSCode als terminal; PowerShell kan beter werken.
---
># Eerste keer opstarten
* Pak het `.zip` bestand uit in een map naar keuze
* Open Laravel Herd en ga naar de Dashboard-pagina\
    Klik op 'Open Sites'\
    Klik linksboven op 'Add' en kies 'Link existing project'\
    Selecteer de uitgepakte map en kies PHP versie 8.3.*
* Wanneer je op de overzichtspagina van je website bent, klik op 'Open' rechts van je gekozen code-editor
* Open in je code-editor de terminal en voer uit:
* `cp .env.example .env`
* `composer install`
* `php artisan key:generate`
* `php artisan migrate:fresh --seed` (ja op alles)
* `npm install`
* `npm run build`
* Ga terug naar de Laravel Herd overzichtspagina van je website en klik op de URL
---

> ## Normaal gebruik
* Open het project in je code-editor en open de terminal
* `npm run build`
* Ga naar de Laravel Herd overzichtspagina van je website en klik op de URL
---
Logininformatie `*`
| email | wachtwoord |
|--|--|
| admin@admin.com | admin |
| account_manager@admin.com | admin |
| product_manager@admin.com | admin |
| backoffice_medewerker@admin.com | admin |
| backoffice_manager@admin.com | admin |
| logistiek_manager@admin.com | admin |

---
>###### *Project gemaakt in 10-2025*
>### Gemaakt door Danijel en Jasper
