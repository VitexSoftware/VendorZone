<?php

namespace VendorZone;

/**
 * vendorzone - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */
require_once 'includes/Init.php';

$oPage->onlyForUser();

$oPage->addItem(new ui\PageTop(_('Nastavení')));

$oPage->container->addItem(new \Ease\TWB\LinkButton('changepassword.php',
    _('Change Password'), 'warning'));

$oPage->container->addItem( new \FlexiPeeHP\ui\StatusInfoBox()  );

$oPage->container->addItem(new \Ease\TWB\LinkButton('flexibeeinit.php',
    _('Init FlexiBee'), 'warning'));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
