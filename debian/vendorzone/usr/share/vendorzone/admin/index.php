<?php
/**
 * VendorZone - Admin login redirect.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */

require_once '../../vendor/autoload.php';

$oPage = new \VendorZone\ui\WebPage();

$oPage->redirect('../adminlogin.php');
