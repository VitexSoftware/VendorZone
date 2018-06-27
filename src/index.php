<?php

namespace VendorZone;

/**
 * clientzone - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */
require_once 'includes/Init.php';


$oPage->addItem(new ui\PageTop(_('clientzone')));

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
    case 'Ease\Anonym': //Anonymous
    default:
        $mainMenu->addMenuItem(
            'images/cennik.png', _('Pricelist'), 'pricelist.php'
        );
        $mainMenu->addMenuItem(
            'images/login.svg', _('Sign in'), 'customerlogin.php'
        );
        $mainMenu->addMenuItem(
            'images/registration.svg', _('Sign up'), 'newcustomer.php'
        );
        break;
}


$oPage->addItem(new ui\PageBottom());

$oPage->draw();
