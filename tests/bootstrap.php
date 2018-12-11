<?php

/**
 * vendorzone - nastavení testů.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */



include_once 'Token.php';
include_once 'Token/Stream.php';
//echo getcwd();

chdir('/home/vitex/Projects/Spoje.Net/vendorzone/src/'); //TODO: relative
//exit;
require_once 'includes/config.php';
require_once 'includes/Init.php';

\Ease\Shared::user(new \VendorZone\User());
\Ease\Shared::webPage(new namespace VendorZone\ui\WebPage());
