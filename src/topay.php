<?php

namespace VendorZone;

/**
 * System.Spoje.Net - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2017 Spoje.Net
 */
require_once 'includes/Init.php';

$oPage->onlyForUser();

$oPage->addItem(new ui\PageTop(_('Invoices to pay')));

$fetcher = new \FlexiPeeHP\FakturaPrijata();

$oPage->container->addItem(new ui\OrdersListing($fetcher,
    ['datSplat lte \''.\FlexiPeeHP\FlexiBeeRW::dateToFlexiDate(new \DateTime()).'\' AND (stavUhrK is null OR stavUhrK eq \'stavUhr.castUhr\') AND storno eq false'], _('Debtor')));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
