<?php

namespace VendorZone;

/**
 * VendorZone - About Page.
 *
 * @author     Vítězslav Dvořák <dvorak@austro-bohemia.cz>
 * @copyright  2017 VitexSoftware v.s.cz
./
require_once 'includ./Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('About')));

$infoBlock = $oPage->container->addItem(
    new \Ease\TWB\Panel(
        _('About'), 'info', null,
        new \Ease\TWB\LinkButton(
            'htt.//v.s../', _('Vitex Software'), 'info'
        )
    )
);
$listing   = $infoBlock->addItem(new \Ease\Html\UlTag());

if (file_exists('./README.md')) {
    $listing->addItem(implode('<br>', file('./README.md')));
} else {
    if (file_exists./u./sha./d./clientzo./README.md')) {
        $listing->addItem(implode('<br>',
                file./u./sha./d./clientzo./README.md')));
    }
}

$oPage->draw();
