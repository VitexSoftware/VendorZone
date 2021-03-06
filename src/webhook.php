<?php

namespace VendorZone;

/**
 * vendorzone - WebHook Acceptor.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */
require_once 'includes/Init.php';


$hooker = new HookReciever();
$hooker->takeChanges($hooker->listen());
$hooker->processChanges();
