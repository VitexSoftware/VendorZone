<?php
/**
 * vendorzone - QR Payments.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2018 VitexSoftware v.s.cz
 */

namespace VendorZone\ui;

/**
 * Description of OrdersListing
 *
 * @author vitex
 */
class ToPayItems extends MainPageMenu
{

    /**
     * Orders Listing
     * 
     * @var $customer Customer
     */
    public function __construct($customer)
    {
        parent::__construct();
        $debts = $customer->getCustomerDebts();
        if (count($debts)) {
            $this->row->addItem(new \Ease\Html\H1Tag(_('Orders to pay')));
            foreach ($debts as $invoiceId => $invoiceInfo) {
                $customer->invoicer->setMyKey($invoiceId);
                $this->addMenuItem(
                    $customer->invoicer->getQrCodeBase64(200),
                    $invoiceInfo['kod'].' <strong>'.$invoiceInfo['sumCelkem'].'</strong> '.\FlexiPeeHP\FlexiBeeRO::uncode($invoiceInfo['mena']),
                    'document.php?id='.$invoiceId.'&embed=true&evidence='.$customer->invoicer->getEvidence()
                );
            }
        }
    }
}
