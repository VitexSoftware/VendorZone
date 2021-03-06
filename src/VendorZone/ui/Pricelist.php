<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace VendorZone\ui;

/**
 * Description of Pricelist
 *
 * @author vitex
 */
class Pricelist extends \Ease\TWB\Panel
{
    /**
     *
     * @var \FlexiPeeHP\Cenik
     */
    public $pricer = null;

    public function __construct($category, $labels = [])
    {
        $order     = new \VendorZone\OrderItem();
        $orderable = [];
        foreach ($order->plugins as $pluginName => $plugin) {
            $orderable[$plugin->productCode] = $pluginName;
        }

        if (count($labels)) {
            foreach ($labels as $lid => $label) {
                $labels[$lid] = 'stitky=\'code:'.$label.'\'';
            }
            $labelCond = implode(' and ', $labels);
            $category  .= ' and '.$labelCond;
        }

        $this->pricer = new \FlexiPeeHP\Cenik();
        $items        = $this->pricer->getColumnsFromFlexibee('info',
            ['(in subtree '.$category.')']);

        parent::__construct(_('Pricelist'), 'info', null,
            new \Ease\TWB\Label('info',
            sprintf(_('%s items found'), count($items))));

        if (count($items)) {
            $headerRow = new \Ease\TWB\Row(null);
            $headerRow->addColumn(1);
            $headerRow->addColumn(2, new \Ease\TWB\Label('info', _('Item name')));
            $headerRow->addColumn(2,
                new \Ease\TWB\Label('info', _('Price without VAT')));
            $headerRow->addColumn(2,
                new \Ease\TWB\Label('info', _('Price with VAT')));
            $headerRow->addColumn(2, new \Ease\TWB\Label('info', _('Actions')));
            $this->addItem( $headerRow);
            $this->addItem('<p><hr/></p>');
            foreach ($items as $item) {

                if (array_key_exists($item['kod'], $orderable)) {
                    $item['service'] = $orderable[$item['kod']];
                } else {
                    $item['service'] = 'Common&kod='.$item['kod'];
                }

                $this->addItem($this->pricelistRow($item));
            }
        }
    }

    public function pricelistRow($pricelistItemData)
    {
        $row = new \Ease\TWB\Row();
        $this->pricer->setMyKey($pricelistItemData['id']);
        $row->addColumn(1,
            new ProductImageThumbnail($this->pricer,
            ['class' => 'thumbnail', 'style' => 'height: 40px']));
        $row->addColumn(2, $pricelistItemData['nazev']);
        $row->addColumn(2, $pricelistItemData['cenaZaklBezDph']);
        $row->addColumn(2, round($pricelistItemData['cenaZaklVcDph']));
        if (array_key_exists('service', $pricelistItemData)) {
            $row->addColumn(2,
                new \Ease\TWB\LinkButton('orderform.php?service='.$pricelistItemData['service'],
                _('Order Now'), 'success'));
        }

        return $row;
    }
}
