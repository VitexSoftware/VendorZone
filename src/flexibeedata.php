<?php

namespace VendorZone;

/**
 * VendorZone - Data source for DataTables.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017-2018 VitexSoftware v.s.cz
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$class  = $oPage->getRequestValue('class');
$filter = $oPage->getRequestValue('filter');

/**
 * @var \FlexiPeeHP\FlexiBeeRW Data Source
 */
$engine = new $class;

if (is_array($filter)) {
    $engine->defaultUrlParams = $filter;
}

unset($_REQUEST['class']);
unset($_REQUEST['_']);

$dataRaw = $engine->getColumnsFromFlexiBee('*', $filter);

header('Content-Type: application/json');
echo json_encode(['data' => $dataRaw, 'recordsTotal' => count($dataRaw)]);
