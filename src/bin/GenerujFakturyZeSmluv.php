<?php

namespace VendorZone;

/**
 * Generování faktur
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2018-2019 Vitex Software
 */
define('EASE_APPNAME', 'GenerujFakturyZeSmluv');
define('EASE_LOGGER', 'console|syslog');


$inc = 'includes/Init.php';
if (!file_exists($inc)) {
    chdir('..');
}
require_once $inc;

$contractor   = new \FlexiPeeHP\Smlouva();
$contractList = $contractor->getColumnsFromFlexibee(['id', 'kod', 'nazev', 'firma']);
foreach ($contractList as $counter => $contractInfo) {
    $contractor->setMyKey($contractInfo['id']);
    $contractor->addStatusMessage($counter.'/'.count($contractList).' '.$contractInfo['kod'].'  '.$contractInfo['nazev'].' '.$contractInfo['firma@showAs'],
        $contractor->generovaniFaktur() ? 'success' : 'error' );
    if (array_key_exists('messages', $contractor->lastResult)) {
        foreach ($contractor->lastResult['messages'] as $message) {
            $contractor->addStatusMessage($counter.'/'.count($contractList).' '.$contractInfo['kod'].': '.$message);
        }
    }
}


