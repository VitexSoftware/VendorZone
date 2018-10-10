<?php
/**
 * clientzone - Init aplikace.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */

namespace VendorZone;

require_once '/var/lib/vendorzone/autoload.php';
if (!defined('EASE_APPNAME')) {
    define('EASE_APPNAME', 'VendorZone');
}

\Ease\Shared::initializeGetText(constant('EASE_APPNAME'), 'en_US', '/usr/share/locale');

session_start();

if (\Ease\Shared::isCli()) {
    if (!defined('EASE_LOGGER')) {
        define('EASE_LOGGER', 'syslog|console|email');
    }
} else {
    /* @var $oPage ui\WebPage */
    $oPage = new ui\WebPage();
}

$engine = new FlexiBeeEngine();

/**
 * Objekt uživatele User nebo Anonym
 * @global \Ease\User
 */
$oUser = \Ease\Shared::user();

