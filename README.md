FlexiBee VendorZone
===================

![VendorZone Logo](https://raw.githubusercontent.com/VitexSoftware/VendorZone/master/src/images/logo.png "Project Logo")

Adminská zóna vašeho FlexiBee. Aplikace taktéž umožňuje objednávání položek ceníku FlexiBee a následnou reakci na příchozí platbu

Administrátor označí v ceníku nabízené položky štítkem ESHOP a ACTIVE. Poté jsou tyto nabízeny k obejdnání:

![Nabídka](https://raw.githubusercontent.com/VitexSoftware/VendorZone/master/doc/VendorZone-screenshot.png "Snímek obrazovky aplikace")

Po volbě položky je možné vyplnit detaily:

![Formulář](https://raw.githubusercontent.com/VitexSoftware/VendorZone/master/doc/VendorZone-order-item-form.png "Formulář položky objednávky")

Objednané položky jsou schraňovány v košíku:

![Potvrzení](https://raw.githubusercontent.com/VitexSoftware/VendorZone/master/doc/VendorZone-confirm-screenshot.png "Potvrzení obejdnávky")

Výsledkem je buď zálohová faktura, nebo objednávka ve FlexiBee:

![Objednáno](https://raw.githubusercontent.com/VitexSoftware/VendorZone/master/doc/VendorZone-order-done.png "Dokončená objednávka")


Vlastnosti
----------


**Funkce automatizace**

 * Příjmání WebHooků
 * Zpracování změn nepřijatých jako webhook
 * Mirror a Historie Evidencí FlexiBee do tabulky databáze
 * Mechanizmus modulů pro reakce na změny v položkách evidencí (faktura uhrazena)
 * Mechanizmus modulů pro reakce na položky zpracovávaných faktur
 * skript api/GetCustomerScore.php pro vracejcí zewl score klienta
 * ukládání parametrů objednaných položek do json přílohy faktury/objednávky
 * Párování faktur
 * Obesílání upomínek

**Funkce pro Administrátora**

 * Nastavení ChangesApi a webhooků na stránce flexibee.php
 * Zakládání a mazání operátorů

**Funkce pro Operátora**
 
 * Rozcestník často používaných aplikací
 * Vyhledávač v Adresách, Kontaktech a Ceníku
 * U adres je možné přepínat štítky
 * U položek ceníku je možné přepínat štítky a tím povolovat jejich zobrazení v nabídce zákazníkům
 * Nabízeným položkám je možné přiřadit obrázek a jeho náhled. 
 * Zobrazení přehledu objednávek s možností je odeslat zákazníkovi mailem


Moduly pro zpracování změn evidencí
===================================

Načítají se ze složky VendorZone\whplugins např **FakturaPrijata.php** a jsou vždy potomky třídy **\VendorZone\WebHookHandler**

V modulu je možné předefinovat metody create() update() a delete() které se vykonávají při patřičné změně.

Moduly pro zpracování objednaných položek
=========================================

Načítají se ze složky VendorZone\orderplugins např **DomainOrg.php** a jsou vždy potomky třídy **\VendorZone\OrderPlugin**

Plugin může mít předefinovány tyto metody:

 * **formFields($form)**     - vykreslí formulář s položkami potřebnými pro objednání položky  
 * **controlFields($order)** - zkontroluje hodnoty odeslané formulářem
 * **processFields($order)** - zpracuje hodnoty odeslané formulářem
 * **settled()**             - vykonává se v případě že byla zaplacena faktura obsahující položku s kodem který ma plugin na starosti


Testovací adresa: [https://clientzonee.vitexsoftware.cz/]

Požadavky pro běh:
------------------

 * PHP 5 a vyšší s mysqli rozšířením
 * Ease framework 
 * FlexiPeeHP
 * SQL Databáze s podporou PDO

Instalace
---------

Pro instalaci je třeba:

 * přistupové údaje do mysql/postgres 
 * databáze a přidané deb zdroje VitexSoftware

        wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key|sudo apt-key add -
        echo deb http://v.s.cz/ stable main > /etc/apt/sources.list.d/ease.list
        apt update
        apt install clientzonee


Konfigurace:
------------

Aplikace se snaží načíst konfigurační soubor z /etc/flexibee/clientzone.json
Pokud jej nenajde tak jej hledá v kořenu webu ()

```json
{                                                                                                                                          
    "EASE_APPNAME": "VendorZone",                                                                                                      
    "EASE_LOGGER": "syslog|console",                                                                                                       
    "SEND_MAILS_FROM": "shop@syourdomain.net",                                                                                                
    "EMAIL_FROM": "shop@yourdomain.net",                                                                                                                       
    "EASE_EMAILTO": "info@vitexsoftware.cz",                                                                    
    "SUPPRESS_EMAILS": "true",                                                                                                                              
    "SEND_INFO_TO": "office@yourdomain.net",                                                                                                                       
    "DB_HOST": "localhost",                                                                                                                             
    "DB_USERNAME": "clientzone",                                                                                                                            
    "DB_PASSWORD": "clientzone",                                                                                                                            
    "DB_DATABASE": "clientzone",                                                                                                                            
    "DB_PORT": "3306",                                                                                                                                  
    "DB_TYPE": "mysql",                                                                                                                                 
}
```

  * SUPPRESS_EMAILS - Neodesílají se Emaily klientům
  * EASE_EMAILTO    - Komu se odesílají logy po vykonání skriptů
  * SEND_INFO_TO    - Komu se posílá info o nových registracích a objednávkách

Adminská oprávnění pro uživatele: **a:1:{s:5:"admin";s:4:"true";}** 

K jakému FlexiBee se VendorZone připojuje je specifikováno v souboru /etc/flexibee/client.json

```json
{
    "FLEXIBEE_URL": "https://demo.flexibee.eu:5434",
    "FLEXIBEE_LOGIN": "winstorm",
    "FLEXIBEE_PASSWORD": "winstrom",
    "FLEXIBEE_COMPANY": "demo"
}
```


Informace pro vývojáře:
-----------------------

 * Aplikace je vyvíjena pod v NetBeans pod linuxem.
 * Dokumentace ApiGen se nalézá ve složce doc
 * Složka testing obsahuje testovací sady Selenium a PHPUnit a strukturu DB
 * Aktuální zdrojové kody: **git@github.com:VitexSoftware/VendorZone.git**

Instalace databáze
------------------


    mysqladmin -u root -p create clientzone
    mysql -u root -p -e "GRANT ALL PRIVILEGES ON clientzone.* TO 'clientzone'@'localhost' IDENTIFIED BY 'clientzone'"

    su postgres
    psql 
    CREATE USER clientzone WITH PASSWORD 'clientzone';
    CREATE DATABASE clientzone OWNER clientzone;
    \q
    vendor/bin/phinx migrate






© 2017 Vítězslav Dvořák / Vitex Software
