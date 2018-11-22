<?php
/**
 * vendorzone - Init aplikace.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */

namespace VendorZone;

require_once '../vendor/autoload.php';
if (!defined('EASE_APPNAME')) {
    define('EASE_APPNAME', 'VendorZone');
}

\Ease\Shared::initializeGetText(constant('EASE_APPNAME'), 'en_US', '../i18n');

session_start();

$shared = \Ease\Shared::instanced();

if (\Ease\Shared::isCli()) {
    if (!defined('EASE_LOGGER')) {
        define('EASE_LOGGER', 'syslog|console|email');
    }
} else {
    /* @var $oPage ui\WebPage */
    $oPage = new ui\WebPage();
}


if (file_exists('/etc/flexibee/vendorzone.json')) {
    $configFile = '/etc/flexibee/vendorzone.json';
} else {
    $configFile = '../vendorzone.json';
}
$shared->loadConfig($configFile,true);

if (file_exists('/etc/flexibee/client.json')) {
    $configFile = '/etc/flexibee/client.json';
} else {
    $configFile = '../client.json';
}
$shared->loadConfig($configFile,true);

/**
 * Objekt uživatele User nebo Anonym
 * @global \Ease\User
 */
$oUser = \Ease\Shared::user();

