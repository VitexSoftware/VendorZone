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

$oPage->addItem(new ui\PageTop(_('Vendor Zone')));

$mainMenu = $oPage->container->addItem(new ui\MainPageMenu());

switch (get_class($oUser)) {
    case 'VendorZone\User': //Admin
        $mainMenu->addMenuItem(
            'images/cennik.png', _('Pricelist'), 'adminpricelist.php'
        );
        $mainMenu->addMenuItem(
            'images/flexibee.png', _('FlexiBee'),
            constant('FLEXIBEE_URL').'/c/'.constant('FLEXIBEE_COMPANY')
        );

        break;
}


$oPage->addItem(new ui\PageBottom());

$oPage->draw();
