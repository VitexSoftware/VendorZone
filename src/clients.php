<?php

namespace VendorZone;

/**
 * VendorZone - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017-2018 VitexSoftware v.s.cz
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Clients')));


$engine = new \FlexiPeeHP\Adresar();
$tabler = new ui\ClientsDataTable($engine);

$oPage->addItem($tabler);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
